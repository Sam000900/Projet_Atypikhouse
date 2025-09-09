<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function sitemap(): Response
    {
        $urls = [
            [
                'loc' => url('/'),
                'priority' => '1.0',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/decouvrir'),
                'priority' => '0.8',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/hebergement'),
                'priority' => '0.8',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/experiences'),
                'priority' => '0.8',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/connexion'),
                'priority' => '0.8',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/inscription'),
                'priority' => '0.8',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/devenir-hote'),
                'priority' => '0.7',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/contact'),
                'priority' => '0.7',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/faq'),
                'priority' => '0.5',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/blog'),
                'priority' => '0.5',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/mentions-legales'),
                'priority' => '0.3',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/conditions-generales-utilisation'),
                'priority' => '0.3',
                'lastmod' => '2025-08-20',
            ],
            [
                'loc' => url('/conditions-generales-ventes'),
                'priority' => '0.3',
                'lastmod' => '2025-08-20',
            ],
        ];

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
