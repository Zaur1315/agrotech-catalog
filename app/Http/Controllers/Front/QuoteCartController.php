<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreQuoteCartLeadRequest;
use App\Models\Product;
use App\Services\Cart\QuoteCartService;
use App\Services\Lead\LeadContextFactory;
use App\Services\Lead\ProductLeadService;
use App\Services\Meta\MetaConversionsApiService;
use App\Services\Meta\MetaPixelEventFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class QuoteCartController extends Controller
{
    public function index(QuoteCartService $cart): View
    {
        return view('front.quote.index', [
            'items' => $cart->items(),
        ]);
    }

    public function add(Product $product, QuoteCartService $cart): RedirectResponse
    {
        abort_if(
            ! $product->is_active || $product->status !== Product::STATUS_AVAILABLE,
            404,
        );

        $cart->add($product);

        return back()->with('success', 'Equipment added to quote list.');
    }

    public function remove(Product $product, QuoteCartService $cart): RedirectResponse
    {
        $cart->remove($product->id);

        return back()->with('success', 'Equipment removed from quote list.');
    }

    /**
     * @throws \Throwable
     */
    public function submit(
        StoreQuoteCartLeadRequest $request,
        QuoteCartService $cart,
        ProductLeadService $leadService,
        LeadContextFactory $leadContextFactory,
        MetaPixelEventFactory $metaPixelEventFactory,
        MetaConversionsApiService $metaConversionsApiService,
    ): RedirectResponse {
        $items = $cart->items();

        if ($items->isEmpty()) {
            return redirect()
                ->route('quote.index')
                ->with('error', 'Your quote list is empty.');
        }

        $metaEvent = $metaPixelEventFactory->makeLead();

        $lead = $leadService->createFromQuoteCart(
            $items,
            $request->validated(),
            $leadContextFactory->fromRequest($request),
        );

        $metaConversionsApiService->sendLead($lead, $metaEvent['event_id']);

        $cart->clear();

        return redirect()
            ->route('quote.index')
            ->with('success', 'Thank you! Your quote request has been sent successfully.')
            ->with('meta_event', array_merge($metaEvent, [
                'email' => $lead->email,
                'phone' => $lead->phone,
                'customer_name' => $lead->name,
                'fbp' => $lead->fbp,
                'fbc' => $lead->fbc,
            ]));
    }
}
