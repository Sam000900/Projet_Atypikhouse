<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    // CREATE 
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        Contact::create($validated);
        return back();
    }

    // READ
    public function getLastFiftyContacts()
    {
        return ContactResource::collection(
            Contact::orderBy('id', 'desc')->paginate(50)
        );
    }

    // UPDATE
    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return response()->json($contact->fresh());
    }

    public function markAsUnread(Contact $contact)
    {
        $contact->update(['is_read' => false]);
        return response()->json($contact->fresh());
    }

    // DELETE
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
