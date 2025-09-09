<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleFullResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class ArticleController extends Controller
{
    // CREATE
    /* Store an article with its image in the database and add the image in the storage public directory */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image_path'] = $request->file('image')->store('articles-images', 'public');
        $validated['user_id'] = $request->user()->id;
        Article::create($validated);
        return to_route('dashboard/articles');
    }

    // READ
    public function getArticleById($articleId)
    {
        return Article::with('user')->findOrFail($articleId);
    }

    public function getAllArticles()
    {
        return Article::with('user')->orderBy('id', 'desc')->get();
    }

    public function getLastSixArticles()
    {
        return Article::with('user')->orderBy('id', 'desc')->take(6)->get();
    }

    public function getLastHundredArticles()
    {
        return ArticleFullResource::collection(
            Article::with('user')->orderBy('id', 'desc')->paginate(100)
        );
    }

    // UPDATE
    /* Update an existing article and its image (if the image has changed) in the database  */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($article->image_path && !str_starts_with($article->image_path, 'images/seeder-images')) {
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

        if ($imagePath && !str_starts_with($imagePath, 'images/seeder-images')) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $article->delete();
    }
}
