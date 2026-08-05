<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class NewLeadNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Lead $lead,
    ) {
    }

    public function build(): self
    {
        $this->lead->loadMissing(['items.product']);

        return $this
            ->from(
                config('mail.from.address'),
                config('services.leads.from_name', config('mail.from.name')),
            )
            ->subject($this->makeSubject())
            ->view('emails.leads.new-lead-notification');
    }

    private function makeSubject(): string
    {
        return match ($this->lead->type) {
            Lead::TYPE_QUOTE => "New Quote Request — Moore's Farm Equipment",
            Lead::TYPE_PRODUCT_QUESTION => "New Product Question — Moore's Farm Equipment",
            Lead::TYPE_SERVICE => "New Service Request — Moore's Farm Equipment",
            Lead::TYPE_DELIVERY => "New Delivery Request — Moore's Farm Equipment",
            Lead::TYPE_FINANCING => "New Financing Request — Moore's Farm Equipment",
            default => "New Website Lead — Moore's Farm Equipment",
        };
    }
}
