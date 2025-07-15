<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class ArticleController extends Controller
{
    // CREATE
    /* Store an article with its image in the database and add the image in the storage public directory */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string|max:51150',
            'conclusion' => 'string|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image_path = $request->file('image')->store('articles-images', 'public');

        Article::create([
            'name' => $request->name,
            'text' => $request->text,
            'conclusion' => $request->conclusion,
            'image_path' => $image_path,
            'user_id' => $request->user()->id,
        ]);

        return to_route('dashboard/articles');
    }

    // READ
    public function getArticleById($articleId)
    {
        return Article::where('id', $articleId)->get();
    }

    public function getAllArticles()
    {
        return Article::orderBy('id', 'desc')->get();
    }

    public function getLastSixArticles()
    {
        return Article::orderBy('id', 'desc')->take(6)->get();
    }

    // UPDATE
    /* Update an existing article and its image (if the image has changed) in the database  */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string|max:51150',
            'conclusion' => 'string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image_path && !str_starts_with($article->image_path, 'seeder-images')) {
                if (Storage::disk('public')->exists($article->image_path)) {
                    Storage::disk('public')->delete($article->image_path);
                }
            }

            $validated['image_path'] = $request->file('image')->store('articles-images', 'public');
        }

        $article->update($validated);

        return to_route('dashboard/articles');
    }

    // DELETE
    /* Delete an article with its image from the database and the storage public folder */
    public function destroy(Article $article)
    {
        $imagePath = $article->image_path;

        if ($imagePath && !str_starts_with($imagePath, 'seeder-images')) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $article->delete();
    }
}
