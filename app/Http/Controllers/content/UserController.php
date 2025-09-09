<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserFullResource;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    // READ
    public function getLoggedUser()
    {
        return new UserResource(Auth::user());
    }

    public function getLastHundredUsers()
    {
        return UserFullResource::collection(
            User::with(['accommodations', 'experiences', 'articles'])->orderBy('id', 'desc')->paginate(100)
        );
    }

    // UPDATE
    public function update(UpdateUserRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($user->image_path && !str_starts_with($user->image_path, 'images/seeder-images')) {
                if (Storage::disk('public')->exists($user->image_path)) {
                    Storage::disk('public')->delete($user->image_path);
                }
            }

            $validated['image_path'] = $request->file('image')->store('users-images', 'public');
        }

        $user->update($validated);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(User $user)
    {
        $imagePath = $user->image_path;

        if ($imagePath && !str_starts_with($imagePath, 'images/seeder-images')) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $user->delete();
    }
}


