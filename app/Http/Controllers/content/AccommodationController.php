<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Accommodation;
use App\Models\AccommodationImage;
use Illuminate\Support\Facades\Log;

// Log::info($request);

class AccommodationController extends Controller
{
    // CREATE
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'area' => 'required|integer',
            'capacity' => 'required|integer',
            'bedrooms' => 'required|integer',
            'department' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'address' => 'required|string|max:3069',
            'description' => 'required|string|max:51150',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'wifi' => 'boolean',
            'air_conditioning' => 'boolean',
            'parking' => 'boolean',
            'spa' => 'boolean',
            'equipped_kitchen' => 'boolean',
            'household_linen_provided' => 'boolean',
            'bathroom' => 'boolean',
            'price_night' => 'required|decimal:0,2',
            'min_number_nights' => 'required|integer',
            'security_deposit' => 'required|decimal:0,2',
            'cleaning_charges' => 'required|decimal:0,2',
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i',
            'smokers_allowed' => 'boolean',
            'pets_allowed' => 'boolean',
            'events_allowed' => 'boolean',
            'minimun_age' => 'integer',
            'additional_rules' => 'string|max:51150',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $mainImagePath = null;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('users-images', 'public');

                if ($index === 0) {
                    $mainImagePath = $path;
                }
            }
        }

        $accommodation = Accommodation::create([
            'name' => $request->name,
            'type' => $request->type,
            'area' => $request->area,
            'capacity' => $request->capacity,
            'bedrooms' => $request->bedrooms,
            'department' => $request->department,
            'municipality' => $request->municipality,
            'address' => $request->address,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'main_image' => $mainImagePath,
            'wifi' => $request->wifi,
            'air_conditioning' => $request->air_conditioning,
            'parking' => $request->parking,
            'spa' => $request->spa,
            'equipped_kitchen' => $request->equipped_kitchen,
            'household_linen_provided' => $request->household_linen_provided,
            'bathroom' => $request->bathroom,
            'price_night' => $request->price_night,
            'min_number_nights' => $request->min_number_nights,
            'security_deposit' => $request->security_deposit,
            'cleaning_charges' => $request->cleaning_charges,
            'arrival_time' => $request->arrival_time,
            'departure_time' => $request->departure_time,
            'smokers_allowed' => $request->smokers_allowed,
            'pets_allowed' => $request->pets_allowed,
            'events_allowed' => $request->events_allowed,
            'minimum_age' => $request->minimum_age,
            'additional_rules' => $request->additional_rules,
            'user_id' => $request->user()->id,
        ]);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('users-images', 'public');

            AccommodationImage::create([
                'accommodation_id' => $accommodation->id,
                'image_path' => $path,
                'is_main' => $index === 0,
            ]);
        }

        return to_route('dashboard/logements');
    }

    // READ
    public function __invoke()
    {
        return Accommodation::all();
    }

    public function getUserAccommodations(Request $request)
    {
        return Accommodation::where('user_id', $request->user()->id)->get();
    }

    public function getLastNineAccommodations()
    {
        return Accommodation::orderBy('id', 'desc')->paginate(9);
    }

    public function getLastThreeAccommodations()
    {
        return Accommodation::orderBy('id', 'desc')->take(3)->get();
    }

    public function getAccommodationsByTypes()
    {
        $accommodations_bubbles = Accommodation::where('type', 'Bulle')->orderBy('id', 'desc')->take(5)->get();
        $accommodations_yurts = Accommodation::where('type', 'Yourte')->orderBy('id', 'desc')->take(5)->get();
        $accommodations_barges = Accommodation::where('type', 'Péniche')->orderBy('id', 'desc')->take(5)->get();
        $accommodations_cabins = Accommodation::where('type', 'Cabane')->orderBy('id', 'desc')->take(5)->get();
        $accommodations_random = Accommodation::inRandomOrder()->take(5)->get();

        return [
            'bubbles' => $accommodations_bubbles,
            'yurts' => $accommodations_yurts,
            'barges' => $accommodations_barges,
            'cabins' => $accommodations_cabins,
            'random' => $accommodations_random,
        ];
    }

    // UPDATE
    public function update(Request $request, Accommodation $accommodation): RedirectResponse
    {
        $request->merge([
            'arrival_time' => Carbon::parse($request->arrival_time)->format('H:i'),
            'departure_time' => Carbon::parse($request->departure_time)->format('H:i'),
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'area' => 'required|integer',
            'capacity' => 'required|integer',
            'bedrooms' => 'required|integer',
            'department' => 'required|string|max:1024',
            'municipality' => 'required|string|max:1024',
            'address' => 'required|string|max:3069',
            'description' => 'required|string|max:51150',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'wifi' => 'boolean',
            'air_conditioning' => 'boolean',
            'parking' => 'boolean',
            'spa' => 'boolean',
            'equipped_kitchen' => 'boolean',
            'household_linen_provided' => 'boolean',
            'bathroom' => 'boolean',
            'price_night' => 'required|decimal:0,2',
            'min_number_nights' => 'required|integer',
            'security_deposit' => 'required|decimal:0,2',
            'cleaning_charges' => 'required|decimal:0,2',
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i',
            'smokers_allowed' => 'boolean',
            'pets_allowed' => 'boolean',
            'events_allowed' => 'boolean',
            'minimun_age' => 'integer',
            'additional_rules' => 'string|max:51150',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $accommodation->arrival_time = $request->arrival_time;
        $accommodation->departure_time = $request->departure_time;
        $accommodation->update($request->all());

        return to_route('dashboard/logements');
    }

    // DELETE
    public function destroy(Accommodation $accommodation)
    {
        foreach ($accommodation->images as $image) {
            if (!str_starts_with($image->image_path, 'images/seeder-images')) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        $accommodation->delete();
    }
}
