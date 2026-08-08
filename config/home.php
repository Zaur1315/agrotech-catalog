<?php

declare(strict_types=1);

return [
    'hero' => [
        'autoplay' => true,
        'interval' => 6500,
        'slides' => [
            [
                'eyebrow' => 'Farm & Construction Equipment',
                'title' => 'Equipment Built for the Work Ahead',
                'description' => 'Explore dependable equipment for farms, job sites, properties, and commercial operations.',
                'image' => 'images/home/hero/tractor-field.webp',
                'image_alt' => 'Farm tractor working in a field',
                'primary_cta' => ['label' => 'View Inventory', 'route' => 'catalog.index'],
                'secondary_cta' => ['label' => 'Contact Our Team', 'route' => 'contact.index'],
            ],
            [
                'eyebrow' => 'A Range of Equipment',
                'title' => 'Find the Right Machine for the Job',
                'description' => 'Browse tractors, excavators, loaders, attachments, and other equipment available through Moore\'s Farm Equipment.',
                'image' => 'images/home/hero/excavator-jobsite.webp',
                'image_alt' => 'Excavator working on a construction site',
                'primary_cta' => ['label' => 'Browse Equipment', 'route' => 'catalog.index'],
                'secondary_cta' => ['label' => 'Call Us', 'url' => 'tel:+16154526099'],
            ],
            [
                'eyebrow' => 'Gallatin, Tennessee',
                'title' => 'Local Equipment Support Starts Here',
                'description' => 'Connect with our team in Gallatin to discuss available equipment and your next project.',
                'image' => 'images/home/hero/loader-farm.webp',
                'image_alt' => 'Heavy loader at a rural equipment yard',
                'primary_cta' => ['label' => 'Explore Inventory', 'route' => 'catalog.index'],
                'secondary_cta' => ['label' => 'Get Directions', 'url' => 'https://www.google.com/maps/place/?q=place_id:ChIJg65VLug6ZIgRuzNdy5TvArQ'],
            ],
        ],
    ],
    'trust_bar' => [
        ['title' => 'Multiple Industries', 'description' => 'Farm, construction, utility, and commercial equipment.'],
        ['title' => 'Gallatin, Tennessee', 'description' => 'A local point of contact for your next machine.'],
        ['title' => 'Direct Contact', 'description' => 'Call or email the team about any listing.'],
        ['title' => 'Online Inventory', 'description' => 'Review current listings and available details.'],
    ],
    'why_us' => [
        'eyebrow' => "Why Moore's Farm Equipment",
        'title' => 'Straightforward Equipment Buying',
        'description' => 'Browse available equipment, review the details, and contact our team when you are ready to learn more.',
        'image' => 'images/home/sections/why-moores.webp',
        'image_alt' => 'Agricultural tractor in a rural equipment yard',
        'items' => [
            ['title' => 'Practical Equipment Selection', 'description' => 'Explore equipment for agricultural, construction, utility, and commercial applications.'],
            ['title' => 'Clear Listing Information', 'description' => 'Review available photos, specifications, pricing, and listing details before contacting us.'],
            ['title' => 'Local Point of Contact', 'description' => 'Speak directly with our team in Gallatin, Tennessee about available equipment.'],
            ['title' => 'Simple Inquiry Process', 'description' => 'Contact us by phone, email, or the website to discuss a machine that interests you.'],
        ],
    ],
    'applications' => [
        'eyebrow' => 'Equipment for the Work You Do',
        'title' => 'Built Around Real-World Jobs',
        'items' => [
            ['title' => 'Farm Equipment', 'description' => 'Equipment for field work, property maintenance, material handling, and daily farm operations.', 'image' => 'images/home/applications/farm-equipment-v2.webp', 'image_alt' => 'Tractor working across farmland'],
            ['title' => 'Construction Equipment', 'description' => 'Machines for excavation, loading, grading, site preparation, and construction work.', 'image' => 'images/home/applications/construction-equipment-v2.webp', 'image_alt' => 'Excavator and loader working on a construction site'],
            ['title' => 'Utility & Attachments', 'description' => 'Versatile equipment and attachments for property, landscaping, and commercial projects.', 'image' => 'images/home/applications/utility-attachments.webp', 'image_alt' => 'Compact skid-steer loader with attachment beside a barn'],
        ],
    ],
    'process' => [
        'eyebrow' => 'How It Works',
        'title' => 'A Simple Way to Find Equipment',
        'background_image' => 'images/home/sections/equipment-yard.webp',
        'steps' => [
            ['number' => '01', 'title' => 'Browse Inventory', 'description' => 'Review current listings, photos, specifications, and available equipment categories.'],
            ['number' => '02', 'title' => 'Contact Our Team', 'description' => 'Call or send an inquiry with the equipment listing and questions you have.'],
            ['number' => '03', 'title' => 'Discuss the Next Step', 'description' => 'Coordinate directly with our team regarding the machine and available next steps.'],
        ],
    ],
    'about' => [
        'eyebrow' => "Moore's Farm Equipment",
        'title' => 'Equipment for Farms, Properties, and Job Sites',
        'description' => "Based in Gallatin, Tennessee, Moore's Farm Equipment connects buyers with agricultural, construction, utility, and commercial equipment.",
        'image' => 'images/home/sections/farm-equipment-lineup.webp',
        'image_alt' => 'Lineup of agricultural and construction equipment',
        'cta_label' => 'About Our Company',
        'cta_route' => 'pages.about',
    ],
    'faq' => [
        'eyebrow' => 'Frequently Asked Questions',
        'title' => 'Questions Before You Contact Us?',
        'image' => 'images/home/sections/faq-tractor-cab.webp',
        'image_alt' => 'Tractor cab and controls in an equipment yard',
        'items' => [
            ['question' => 'How can I ask about a specific machine?', 'answer' => 'Open the equipment listing and use the available inquiry option, or contact us by phone or email with the listing name.'],
            ['question' => "Where is Moore's Farm Equipment located?", 'answer' => 'We are located at 1410 S Water Ave, Gallatin, TN 37066, USA.'],
            ['question' => 'Does the available inventory change?', 'answer' => 'Yes. Equipment listings may change as machines are added, reserved, or sold. Check the inventory page for current availability.'],
            ['question' => 'Can I contact you before visiting?', 'answer' => 'Yes. Call +1 615 452 6099 or email sales@mooresfarmequipment.com before visiting.'],
            ['question' => 'Where can I find equipment specifications?', 'answer' => 'Available specifications, images, pricing, and listing details are shown on the individual equipment page when provided.'],
        ],
    ],
    'final_cta' => [
        'eyebrow' => 'Start Your Equipment Search',
        'title' => 'See What Is Available Today',
        'description' => "Browse our current equipment listings or contact the Moore's Farm Equipment team in Gallatin.",
        'background_image' => 'images/home/sections/available-today.webp',
        'primary_cta_label' => 'View Inventory',
        'primary_cta_route' => 'catalog.index',
        'secondary_cta_label' => 'Call +1 615 452 6099',
        'secondary_cta_url' => 'tel:+16154526099',
    ],
];
