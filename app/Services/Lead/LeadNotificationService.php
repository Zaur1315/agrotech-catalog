<?php

declare(strict_types=1);

namespace App\Services\Lead;

use App\Mail\NewLeadNotificationMail;
use App\Models\Lead;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

final readonly class LeadNotificationService
{
    public function sendNewLeadNotification(Lead $lead): void
    {
        $recipient = config('services.leads.notification_email');

        if ($recipient === null || $recipient === '') {
            Log::warning('Lead notification recipient is not configured.', [
                'lead_id' => $lead->id,
            ]);

            return;
        }

        try {
            Mail::to($recipient)->send(new NewLeadNotificationMail($lead));
        } catch (Throwable $exception) {
            Log::error('Failed to send lead notification email.', [
                'lead_id' => $lead->id,
                'recipient' => $recipient,
                'exception' => $exception->getMessage(),
            ]);
        }
    }
}
