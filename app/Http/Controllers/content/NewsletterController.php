<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    // CREATE 
    public function store(StoreNewsletterRequest $request)
    {
        $validated = $request->validated();
        Newsletter::create($validated);
        return back();
    }

    // READ
    public function getLastFiftyNewsletters()
    {
        return NewsletterResource::collection(
            Newsletter::orderBy('id', 'desc')->paginate(50)
        );
    }

    // DELETE
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
    }
}
