<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreProductLeadRequest;
use App\Models\Product;
use App\Services\Lead\LeadContextFactory;
use App\Services\Lead\ProductLeadService;
use App\Services\Meta\MetaConversionsApiService;
use App\Services\Meta\MetaPixelEventFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ProductController extends Controller
{
    public function show(Product $product, MetaPixelEventFactory $metaPixelEventFactory): View
    {
        abort_if(! $product->is_active || $product->status === Product::STATUS_HIDDEN, 404);

        $product->load([
            'category',
            'brand',
            'images',
            'specifications',
        ]);

        $relatedProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('status', Product::STATUS_AVAILABLE)
            ->whereKeyNot($product->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('front.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'metaViewContentEvent' => $metaPixelEventFactory->makeViewContent($product),
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function quote(
        StoreProductLeadRequest $request,
        Product $product,
        ProductLeadService $leadService,
        LeadContextFactory $leadContextFactory,
        MetaPixelEventFactory $metaPixelEventFactory,
        MetaConversionsApiService $metaConversionsApiService,
    ): RedirectResponse {
        abort_if(
            ! $product->is_active || $product->status !== Product::STATUS_AVAILABLE,
            404,
        );

        $metaEvent = $metaPixelEventFactory->makeLead();

        $lead = $leadService->createFromProduct(
            $product,
            $request->validated(),
            $leadContextFactory->fromRequest($request),
        );

        $metaConversionsApiService->sendLead($lead, $metaEvent['event_id']);

        return redirect()
            ->route('products.show', $product)
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
