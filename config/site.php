<?php

declare(strict_types=1);

return [
    'name' => env('SITE_NAME', "Moore's Farm Equipment"),
    'phone' => env('SITE_PHONE', '+1 615 452 6099'),
    'phone_tel' => env('SITE_PHONE_TEL', '+16154526099'),
    'email' => env('SITE_EMAIL', 'sales@mooresfarmequipment.com'),
    'address' => env('SITE_ADDRESS', '1410 S Water Ave, Gallatin, TN 37066, USA'),
    'maps_url' => env('SITE_MAPS_URL', 'https://www.google.com/maps/place/?q=place_id:ChIJg65VLug6ZIgRuzNdy5TvArQ'),
    'city' => env('SITE_CITY', 'Gallatin'),
    'state' => env('SITE_STATE', 'TN'),
    'zip' => env('SITE_ZIP', '37066'),
    'country' => env('SITE_COUNTRY', 'USA'),
];
