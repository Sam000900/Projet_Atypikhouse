<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Content\AccommodationController;
use App\Http\Controllers\Content\AccommodationImageController;
use App\Http\Controllers\Content\ArticleController;
use App\Http\Controllers\Content\AccommodationReservationController;
use App\Http\Controllers\Content\ExperienceController;
use App\Http\Controllers\Content\ExperienceReservationController;
use App\Http\Controllers\Content\UserController;
use App\Http\Controllers\Content\SitemapController;
use App\Http\Controllers\Content\NewsletterController;
use App\Http\Controllers\Content\ContactController;

/* Static pages */
Route::get('/', function () { return Inertia::render('Accueil'); })->name('accueil');
Route::get('decouvrir', function () { return Inertia::render('Decouvrir'); })->name('decouvrir');
Route::get('hebergement', function () { return Inertia::render('Hebergement'); })->name('hebergement');
Route::get('devenir-hote', function () { return Inertia::render('DevenirHote'); })->name('devenir-hote');
Route::get('contact', function () { return Inertia::render('Contact'); })->name('contact');
Route::get('faq', function () { return Inertia::render('Faq'); })->name('faq');
Route::get('blog', function () { return Inertia::render('Blog'); })->name('blog');
Route::get('experiences', function () { return Inertia::render('Experiences'); })->name('experiences');
Route::get('connexion', function () { return Inertia::render('Connexion'); })->name('connexion');
Route::get('inscription', function () { return Inertia::render('Inscription'); })->name('inscription');
Route::get('mentions-legales', function () { return Inertia::render('MentionsLegales'); })->name('mentions-legales');
Route::get('conditions-generales-utilisation', function () { return Inertia::render('ConditionsGeneralesUtilisation'); })->name('conditions-generales-utilisation');
Route::get('conditions-generales-ventes', function () { return Inertia::render('ConditionsGeneralesVentes'); })->name('conditions-generales-ventes');

/* Dynamic pages  */
Route::get('article-unique', function (Request $request) { return Inertia::render('ArticleUnique', ['uniqueArticleData' => $request->input('data')]); })->name('article-unique');
Route::get('logement-unique', function (Request $request) { return Inertia::render('LogementUnique', ['accommodationData' => $request->input('data')]); })->name('logement-unique');
Route::get('experience-unique', function (Request $request) { return Inertia::render('ExperienceUnique', ['experienceData' => $request->input('data')]); })->name('experience-unique');

/* Database data fetching */
Route::get('accommodations', [AccommodationController::class, '__invoke']);
Route::get('accommodations/getLastNine', [AccommodationController::class, 'getLastNineAccommodations']);
Route::get('accommodations/getLastThree', [AccommodationController::class, 'getLastThreeAccommodations']);
Route::get('accommodations/getByTypes', [AccommodationController::class, 'getAccommodationsByTypes']);
Route::get('user-accommodations', [AccommodationController::class, 'getUserAccommodations']);
Route::get('accommodations/search', [AccommodationController::class, 'search']);
Route::get('accommodation-images/{id}', [AccommodationImageController::class, '__invoke']);
Route::get('accommodation-reservations/{id}', [AccommodationReservationController::class, 'getReservationsForAccommodation']);

Route::get('article/{id}', [ArticleController::class, 'getArticleById']);
Route::get('articles/getAll', [ArticleController::class, 'getAllArticles']);
Route::get('articles/getLastSix', [ArticleController::class, 'getLastSixArticles']);

Route::get('experiences/getLastTen', [ExperienceController::class, 'getLastTenExperiences']);
Route::get('experiences/getByTypes', [ExperienceController::class, 'getExperiencesByTypes']);
Route::get('experiences/getUniqueByTypes', [ExperienceController::class, 'getUniqueExperienceByTypes']);
Route::get('experience-reservations/{id}', [ExperienceReservationController::class, 'getReservationsForExperience']);

Route::get('logged-user', [UserController::class, 'getLoggedUser']);

Route::get('sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');

/* Unauthenticated forms requests */
Route::post('newsletter', [NewsletterController::class, 'store'])->name('newsletter');
Route::post('contact', [ContactController::class, 'store'])->name('contact');

/* Authenticated users pages */
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    Route::get('dashboard/logements', function () { return Inertia::render('dashboard/Logements'); })->name('dashboard/logements');
    Route::get('dashboard/articles', function () { return Inertia::render('dashboard/Articles'); })->name('dashboard/articles');
    Route::get('dashboard/experiences', function () { return Inertia::render('dashboard/Experiences'); })->name('dashboard/experiences');
    Route::get('dashboard/reservations', function () { return Inertia::render('dashboard/Reservations'); })->name('dashboard/reservations');
    Route::get('dashboard/communication', function () { return Inertia::render('dashboard/Communication'); })->name('dashboard/communication');
    Route::get('dashboard/gestion-donnees', function () { return Inertia::render('dashboard/GestionDonnees'); })->name('dashboard/gestion-donnees');
    Route::get('dashboard/parameters', function () { return Inertia::render('dashboard/Parametres'); })->name('dashboard/parametres');
});

/* Authenticated users forms requests */
Route::middleware('auth')->group(function () {
    Route::get('accommodations/getLastHundred', [AccommodationController::class, 'getLastHundredAccommodations']);
    Route::post('register-accommodation', [AccommodationController::class, 'store'])->name('register-accommodation');
    Route::post('update-accommodation/{accommodation}', [AccommodationController::class, 'update'])->name('update-accommodation');
    Route::delete('delete-accommodation/{accommodation}', [AccommodationController::class, 'destroy'])->name('delete-accommodation');

    Route::post('book-accommodation', [AccommodationReservationController::class, 'store'])->name('book-accommodation');

    Route::get('articles/getLastHundred', [ArticleController::class, 'getLastHundredArticles']);
    Route::post('register-article', [ArticleController::class, 'store']);
    Route::post('update-article/{article}', [ArticleController::class, 'update'])->name('update-article');
    Route::delete('delete-article/{article}', [ArticleController::class, 'destroy'])->name('delete-article');

    Route::get('experiences/getLastHundred', [ExperienceController::class, 'getLastHundredExperiences']);
    Route::post('register-experience', [ExperienceController::class, 'store']);
    Route::post('update-experience/{experience}', [ExperienceController::class, 'update'])->name('update-experience');
    Route::delete('delete-experience/{experience}', [ExperienceController::class, 'destroy'])->name('delete-experience');

    Route::get('users/getLastHundred', [UserController::class, 'getLastHundredUsers']);
    Route::post('update-self-user', [UserController::class, 'update'])->name('update-user');
    Route::delete('/delete-user/{user}', [UserController::class, 'destroy'])->name('delete-user');

    Route::get('newsletters/getLastFifty', [NewsletterController::class, 'getLastFiftyNewsletters']);

    Route::get('contacts/getLastFifty', [ContactController::class, 'getLastFiftyContacts']);
    Route::patch('/contacts/{contact}/read', [ContactController::class, 'markAsRead']);
    Route::patch('/contacts/{contact}/unread', [ContactController::class, 'markAsUnread']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';