<?php

declare(strict_types=1);

return [
    'name' => env('SITE_NAME', "Moore's Farm Equipment"),
    'contact' => [
        'phone' => env('SITE_PHONE', '+1 615 452 6099'),
        'phone_tel' => env('SITE_PHONE_TEL', '+16154526099'),
        'email' => env('SITE_EMAIL', 'sales@mooresfarmequipment.com'),
        'address' => env('SITE_ADDRESS', '1410 S Water Ave, Gallatin, TN 37066, USA'),
        'maps_url' => env('SITE_MAPS_URL', 'https://www.google.com/maps/place/?q=place_id:ChIJg65VLug6ZIgRuzNdy5TvArQ'),
        'city' => env('SITE_CITY', 'Gallatin'),
        'state' => env('SITE_STATE', 'TN'),
        'zip' => env('SITE_ZIP', '37066'),
        'country' => env('SITE_COUNTRY', 'USA'),
    ],
    // Legacy aliases remain available to existing public pages.
    'phone' => env('SITE_PHONE', '+1 615 452 6099'),
    'phone_tel' => env('SITE_PHONE_TEL', '+16154526099'),
    'email' => env('SITE_EMAIL', 'sales@mooresfarmequipment.com'),
    'address' => env('SITE_ADDRESS', '1410 S Water Ave, Gallatin, TN 37066, USA'),
    'maps_url' => env('SITE_MAPS_URL', 'https://www.google.com/maps/place/?q=place_id:ChIJg65VLug6ZIgRuzNdy5TvArQ'),
    'city' => env('SITE_CITY', 'Gallatin'),
    'state' => env('SITE_STATE', 'TN'),
    'zip' => env('SITE_ZIP', '37066'),
    'country' => env('SITE_COUNTRY', 'USA'),
    'navigation' => [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Inventory', 'route' => 'catalog.index'],
        ['label' => 'Service', 'route' => 'pages.service'],
        ['label' => 'About Us', 'route' => 'pages.about'],
        ['label' => 'Contact', 'route' => 'contact.index'],
    ],
    'equipment_categories' => [],
    'content' => [
        'header_notice' => 'Serving Gallatin, Tennessee and surrounding areas',
        'primary_cta_label' => 'View Inventory',
        'footer_description' => 'Farm, construction, utility, and commercial equipment from a trusted local dealer in Gallatin, Tennessee.',
    ],
    'social_links' => [],
];
