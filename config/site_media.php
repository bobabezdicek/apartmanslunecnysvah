<?php

return [
    'photos' => [
        'hero' => [
            'label' => 'Hero fotka',
            'path' => 'storage/lovable/01-exterior-summer-hero.jpg',
            'used_in' => ['Úvod', 'Galerie'],
            'gallery_key' => 'exterior_summer',
        ],
        'courtyardExterior' => [
            'label' => 'Venkovní dvůr',
            'path' => 'storage/lovable/02-courtyard-exterior.png',
            'used_in' => ['Galerie'],
            'gallery_key' => 'courtyard_exterior',
        ],
        'livingKitchen' => [
            'label' => 'Obývací pokoj s kuchyní',
            'path' => 'storage/lovable/03-living-kitchen-wide.png',
            'used_in' => ['O apartmánu', 'Galerie'],
            'gallery_key' => 'living_kitchen',
        ],
        'livingRoom' => [
            'label' => 'Obývací část',
            'path' => 'storage/lovable/04-living-room.png',
            'used_in' => ['O apartmánu', 'Galerie'],
            'gallery_key' => 'living_room',
        ],
        'bedroom' => [
            'label' => 'Ložnice',
            'path' => 'storage/lovable/05-bedroom.jpg',
            'used_in' => ['Galerie'],
            'gallery_key' => 'bedroom',
        ],
        'bathroom' => [
            'label' => 'Koupelna',
            'path' => 'storage/lovable/06-bathroom.png',
            'used_in' => ['Galerie'],
            'gallery_key' => 'bathroom',
        ],
        'gardenView' => [
            'label' => 'Zahrada s výhledem',
            'path' => 'storage/lovable/07-garden-view.png',
            'used_in' => ['O apartmánu', 'Galerie', 'Rezervace'],
            'gallery_key' => 'garden_view',
        ],
        'terraceView' => [
            'label' => 'Terasa s ohništěm',
            'path' => 'storage/lovable/08-terrace-view.png',
            'used_in' => ['Galerie'],
            'gallery_key' => 'terrace_view',
        ],
        'valleySummer' => [
            'label' => 'Letní údolí',
            'path' => 'storage/lovable/valley-summer.jpg',
            'used_in' => ['Lokalita'],
        ],
        'slopesWinter' => [
            'label' => 'Zimní sjezdovky',
            'path' => 'storage/lovable/slopes-winter.jpg',
            'used_in' => ['Lokalita'],
        ],
        'medvedin' => [
            'label' => 'Medvědín',
            'path' => 'storage/lovable/medvedin.jpg',
            'used_in' => ['Lokalita'],
        ],
    ],

    'gallery_order' => [
        'courtyardExterior' => 'lg:col-span-2 lg:row-span-2',
        'livingKitchen' => 'lg:col-span-2',
        'livingRoom' => 'lg:col-span-2',
        'bathroom' => 'lg:col-span-2 lg:row-span-2',
        'hero' => 'lg:col-span-2',
        'bedroom' => 'lg:col-span-2 lg:row-span-2',
        'gardenView' => 'lg:col-span-2 lg:row-span-2',
        'terraceView' => 'lg:col-span-2',
    ],
];
