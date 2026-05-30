<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreContactLeadRequest;
use App\Services\Lead\ContactLeadService;
use App\Services\Lead\LeadContextFactory;
use App\Services\Meta\MetaConversionsApiService;
use App\Services\Meta\MetaPixelEventFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ContactController extends Controller
{
    public function index(): View
    {
        return view('front.contact.index');
    }

    public function store(
        StoreContactLeadRequest $request,
        ContactLeadService $leadService,
        LeadContextFactory $leadContextFactory,
        MetaPixelEventFactory $metaPixelEventFactory,
        MetaConversionsApiService $metaConversionsApiService,
    ): RedirectResponse {
        $metaEvent = $metaPixelEventFactory->makeLead();

        $lead = $leadService->create(
            $request->validated(),
            $leadContextFactory->fromRequest($request),
        );

        $metaConversionsApiService->sendLead($lead, $metaEvent['event_id']);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Thank you! Your message has been sent successfully.')
            ->with('meta_event', $metaEvent);
    }
}
