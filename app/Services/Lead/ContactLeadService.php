<?php

declare(strict_types=1);

namespace App\Services\Lead;

use App\Models\Lead;

final readonly class ContactLeadService
{
    public function __construct(
        private LeadNotificationService $leadNotificationService,
    )
    {
    }

    /**
     * @param array{
     *     name:string,
     *     phone:string,
     *     email?:string|null,
     *     subject?:string|null,
     *     message?:string|null,
     *     preferred_contact_method?:string|null
     * } $data
     * @param array{
     *     source_page?:string|null,
     *     ip_address?:string|null,
     *     user_agent?:string|null,
     *     utm_source?:string|null,
     *     utm_medium?:string|null,
     *     utm_campaign?:string|null,
     *     utm_content?:string|null,
     *     utm_term?:string|null
     * } $context
     */
    public function create(array $data, array $context = []): Lead
    {
        /** @var Lead $lead */
        $lead = Lead::query()->create([
            'type' => Lead::TYPE_GENERAL,
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'preferred_contact_method' => $data['preferred_contact_method'] ?? Lead::PREFERRED_CONTACT_ANY,
            'subject' => $data['subject'] ?: 'Contact request',
            'message' => $data['message'] ?? null,
            'status' => Lead::STATUS_NEW,
            'source' => 'contact_page',
            'source_page' => $context['source_page'] ?? null,
            'utm_source' => $context['utm_source'] ?? null,
            'utm_medium' => $context['utm_medium'] ?? null,
            'utm_campaign' => $context['utm_campaign'] ?? null,
            'utm_content' => $context['utm_content'] ?? null,
            'utm_term' => $context['utm_term'] ?? null,
            'ip_address' => $context['ip_address'] ?? null,
            'user_agent' => $context['user_agent'] ?? null,
        ]);

        $this->leadNotificationService->sendNewLeadNotification($lead);

        return $lead;
    }
}
