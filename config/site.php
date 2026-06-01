<?php

declare(strict_types=1);

return [
    'name' => env('SITE_NAME', 'Mt. Nebo Tractor'),
    'phone' => env('SITE_PHONE', '+1 555 300 4000'),
    'phone_tel' => env('SITE_PHONE_TEL', '+15553004000'),
    'email' => env('SITE_EMAIL', 'sales@example.com'),
    'address' => env('SITE_ADDRESS', '117 Lazy Eight Ln, Mt Nebo, WV 26679, USA'),
    'maps_url' => env('SITE_MAPS_URL', 'https://www.google.com/maps/place/?q=place_id:ChIJYXsgSSmqTogRkJYcmpuzHrw'),
    'city' => env('SITE_CITY', 'Mt Nebo'),
    'state' => env('SITE_STATE', 'WV'),
    'zip' => env('SITE_ZIP', '26679'),
    'country' => env('SITE_COUNTRY', 'USA'),
];
