<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Http\Resources\ExperienceFullResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Experience;

class ExperienceController extends Controller
{
    // CREATE
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image_path'] = $request->file('image')->store('experiences-images', 'public');
        $validated['user_id'] = $request->user()->id;
        Experience::create($validated);
        Cache::forget('ten_experiences');
        return to_route('dashboard/experiences');
    }

    // READ
    public function getLastTenExperiences()
    {
        return Cache::remember('ten_experiences', now()->addMinutes(30), function () {
            return Experience::with('user')->orderBy('id', 'desc')->paginate(10);
        });
    }

    public function getExperiencesByTypes()
    {
        return Cache::remember('experiences_by_types', now()->addMinutes(10), function () {
            $types = ['Séjours bien-êtres', 'Aventures', 'Gastronomie locale'];

            $experiences = Experience::with('user')->whereIn('type', $types)->orderBy('type')->orderByDesc('id')->get();

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

            $experiences = Experience::with('user')->whereIn('type', $types)->orderBy('type')->orderByDesc('id')->get()->unique('type');

            return [
                'wellness' => $experiences->firstWhere('type', 'Séjours bien-êtres'),
                'adventure' => $experiences->firstWhere('type', 'Aventures'),
                'gastronomy' => $experiences->firstWhere('type', 'Gastronomie locale'),
            ];
        });
    }

    public function getLastHundredExperiences()
    {
        return ExperienceFullResource::collection(
            Experience::with('user')->orderBy('id', 'desc')->paginate(100)
        );
    }

    // UPDATE
    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($experience->image_path && !str_starts_with($experience->image_path, 'images/seeder-images')) {
                if (Storage::disk('public')->exists($experience->image_path)) {
                    Storage::disk('public')->delete($experience->image_path);
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

        if ($imagePath && !str_starts_with($imagePath, 'images/seeder-images')) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $experience->delete();
        Cache::forget('ten_experiences');
    }
}
