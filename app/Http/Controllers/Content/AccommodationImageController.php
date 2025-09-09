<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\AccommodationImage;

class AccommodationImageController extends Controller
{
    public function __invoke($id)
    {
        $images = AccommodationImage::where('accommodation_id', $id)->get();

        return response()->json($images);
    }
}