<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\ExperienceReservation;

class ExperienceReservationController extends Controller
{
    public function getReservationsForExperience($experienceId)
    {
        return ExperienceReservation::all()->where('experience_id', $experienceId);
    }
}
