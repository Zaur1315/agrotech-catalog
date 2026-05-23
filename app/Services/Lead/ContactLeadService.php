<?php

declare(strict_types=1);

namespace App\Services\Lead;

use App\Models\Lead;

final readonly class ContactLeadService
{
    /**
     * @param array{name:string, phone:string, email?:string|null, subject?:string|null, message?:string|null} $data
     */
    public function create(array $data): Lead
    {
        /** @var Lead $lead */
        $lead = Lead::query()->create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'subject' => $data['subject'] ?: 'Contact request',
            'message' => $data['message'] ?? null,
            'status' => Lead::STATUS_NEW,
            'source' => 'contact_page',
        ]);

        return $lead;
    }
}
