<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Http\Resources\AccommodationFullResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Accommodation;
use App\Models\AccommodationImage;
use App\Http\Resources\AccommodationResource;

class AccommodationController extends Controller
{
    // CREATE
    public function store(StoreAccommodationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $mainImagePath = null;
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('accommodations-images', 'public');
                if ($index === 0) {
                    $mainImagePath = $path;
                }
                $images[] = [
                    'path' => $path,
                    'is_main' => $index === 0,
                ];
            }
        }


        $validated['main_image'] = $mainImagePath;
        $accommodation = Accommodation::create($validated);

        if (!empty($images)) {
            foreach ($images as $image) {
                AccommodationImage::create([
                    'accommodation_id' => $accommodation->id,
                    'image_path' => $image['path'],
                    'is_main' => $image['is_main'],
                ]);
            }
        }

        return to_route('dashboard/logements');
    }

    // READ
    public function __invoke()
    {
        return Accommodation::with('user')->get();
    }

    public function getUserAccommodations(Request $request)
    {
        return Accommodation::where('user_id', $request->user()->id)->get();
    }

    public function getLastNineAccommodations()
    {
        return Accommodation::with('user')->orderBy('id', 'desc')->paginate(9);
    }

    public function getLastThreeAccommodations()
    {
        return Accommodation::with('user')->orderBy('id', 'desc')->take(3)->get();
    }

    public function getAccommodationsByTypes()
    {
        $types = [
            'bubbles' => 'Bulle',
            'yurts'   => 'Yourte',
            'barges'  => 'Péniche',
            'cabins'  => 'Cabane',
        ];

        $accommodations = [];

        foreach ($types as $key => $type) {
            $accommodations[$key] = Accommodation::with('user')->where('type', $type)->latest()->take(5)->get();
        }

        $accommodations['random'] = Accommodation::with('user')->inRandomOrder()->take(5)->get();

        return $accommodations;
    }

    public function getLastHundredAccommodations()
    {
        return AccommodationFullResource::collection(
            Accommodation::with('user')->orderBy('id', 'desc')->paginate(100)
        );
    }

    public function search(Request $request)
    {
        $query = Accommodation::query();

        if ($request->filled('location')) {
            $location = strtolower($request->location);

            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(municipality) LIKE ?', ["%{$location}%"])
                ->orWhereRaw('LOWER(department) LIKE ?', ["%{$location}%"]);
            });
        }

        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        if ($request->filled('arrival_date') && $request->filled('departure_date')) {
            $arrival = $request->arrival_date;
            $departure = $request->departure_date;

            $query->whereDoesntHave('reservations', function ($q) use ($arrival, $departure) {
                $q->where(function ($sub) use ($arrival, $departure) {
                    $sub->whereBetween('arrival_date', [$arrival, $departure])
                        ->orWhereBetween('departure_date', [$arrival, $departure])
                        ->orWhere(function ($nested) use ($arrival, $departure) {
                            $nested->where('arrival_date', '<=', $arrival)
                                ->where('departure_date', '>=', $departure);
                        });
                });
            });
        }

        return $query->with('user')->orderBy('id', 'desc')->paginate(9);
    }

    // UPDATE
    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation): RedirectResponse
    {
        $validated = $request->validated();
        $validated['arrival_time'] = Carbon::parse($validated['arrival_time'])->format('H:i');
        $validated['departure_time'] = Carbon::parse($validated['departure_time'])->format('H:i');

        if ($request->hasFile('images')) {
            foreach ($accommodation->images as $oldImage) {
                if ($oldImage->image_path && !str_starts_with($oldImage->image_path, 'images/seeder-images')) {
                    if (Storage::disk('public')->exists($oldImage->image_path)) {
                        Storage::disk('public')->delete($oldImage->image_path);
                    }
                }
                $oldImage->delete();
            }

            $mainImagePath = null;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('accommodations-images', 'public');

                if ($index === 0) {
                    $mainImagePath = $path;
                }

                AccommodationImage::create([
                    'accommodation_id' => $accommodation->id,
                    'image_path' => $path,
                    'is_main' => $index === 0,
                ]);
            }

            $validated['main_image'] = $mainImagePath;
        }

        $accommodation->update($validated);
        return to_route('dashboard/logements');
    }

    // DELETE
    public function destroy(Accommodation $accommodation)
    {
        foreach ($accommodation->images as $image) {
            if (!str_starts_with($image->image_path, 'images/seeder-images')) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
            }
            $image->delete();
        }

        $accommodation->delete();
    }
}
