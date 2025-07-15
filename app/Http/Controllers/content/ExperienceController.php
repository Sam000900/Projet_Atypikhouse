<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Experience;

class ExperienceController extends Controller
{
    // CREATE
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:1024',
            'address' => 'required|string|max:3069',
            'max_number_persons' => 'required|integer',
            'service_duration' => 'required|date_format:H:i',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'additional_information'  => 'required|string|max:51150',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image_path = $request->file('image')->store('experiences-images', 'public');

        Experience::create([
            'name' => $request->name,
            'type' => $request->type,
            'location' => $request->location,
            'address' => $request->address,
            'max_number_persons' => $request->max_number_persons,
            'service_duration' => $request->service_duration,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'price' => $request->price,
            'additional_information'  => $request->additional_information,
            'image_path' => $image_path,
            'user_id' => $request->user()->id,
        ]);

        Cache::forget('ten_experiences');

        return to_route('dashboard/experiences');
    }

    // READ
    public function getLastTenExperiences()
    {
        return Cache::remember('ten_experiences', now()->addMinutes(30), function () {
            return Experience::orderBy('id', 'desc')->paginate(10);
        });
    }

    public function getExperiencesByTypes()
    {
        return Cache::remember('experiences_by_types', now()->addMinutes(10), function () {
            $types = ['Séjours bien-êtres', 'Aventures', 'Gastronomie locale'];

            $experiences = Experience::whereIn('type', $types)->orderBy('type')->orderByDesc('id')->get();

            return [
                'wellness' => $experiences->where('type', 'Séjours bien-êtres')->take(5),
                'adventure' => $experiences->where('type', 'Aventures')->take(5),
                'gastronomy' => $experiences->where('type', 'Gastronomie locale')->take(5),
            ];
        });
    }

    public function getUniqueExperienceByTypes()
    {
        return Cache::remember('unique_experience_by_types', now()->addMinutes(10), function () {
            $types = ['Séjours bien-êtres', 'Aventures', 'Gastronomie locale'];

            $experiences = Experience::whereIn('type', $types)->orderBy('type')->orderByDesc('id')->get()->unique('type');

            return [
                'wellness' => $experiences->firstWhere('type', 'Séjours bien-êtres'),
                'adventure' => $experiences->firstWhere('type', 'Aventures'),
                'gastronomy' => $experiences->firstWhere('type', 'Gastronomie locale'),
            ];
        });
    }

    // UPDATE
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:1024',
            'address' => 'required|string|max:3069',
            'max_number_persons' => 'required|integer',
            'service_duration' => 'required|date_format:H:i',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'additional_information'  => 'required|string|max:51150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $experience->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && !str_starts_with($imagePath, 'seeder-images')) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $validated['image_path'] = $request->file('image')->store('experiences-images', 'public');
        }

        $experience->update($validated);

        Cache::forget('ten_experiences');

        return to_route('dashboard/experiences');
    }

    // DELETE
    public function destroy(Experience $experience)
    {
        $imagePath = $experience->image_path;

        if ($imagePath && !str_starts_with($imagePath, 'seeder-images')) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $experience->delete();

        Cache::forget('ten_experiences');
    }
}
