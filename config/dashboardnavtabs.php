<?php

return [
    [
        'text' => 'Tableau de bord',
        'href' => 'dashboard',
        'icon' => 'Chart',
        'forRole' => ['owner', 'admin'],
    ],
    [
        'text' => 'Réservations',
        'href' => 'dashboard/reservations',
        'icon' => 'Calendar',
        'forRole' => ['tenant'],
    ],
    [
        'text' => 'Articles',
        'href' => 'dashboard/articles',
        'icon' => 'NoteText',
        'forRole' => ['admin'],
    ],
    [
        'text' => 'Experiences',
        'href' => 'dashboard/experiences',
        'icon' => 'SunFog',
        'forRole' => ['admin'],
    ],
    [
        'text' => 'Logements',
        'href' => 'dashboard/logements',
        'icon' => 'House',
        'forRole' => ['owner', 'admin'],
    ],
    [
        'text' => 'Communication',
        'href' => 'dashboard/communication',
        'icon' => 'People',
        'forRole' => ['admin'],
    ],
    [
        'text' => 'Gestion des données',
        'href' => 'dashboard/gestion-donnees',
        'icon' => 'Data',
        'forRole' => ['admin'],
    ],
    [
        'text' => 'Paramètres',
        'href' => 'dashboard/parametres',
        'icon' => 'Setting2',
        'forRole' => ['owner', 'tenant', 'admin'],
    ],
];