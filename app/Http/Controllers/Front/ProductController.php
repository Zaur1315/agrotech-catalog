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
use Illuminate\Http\JsonResponse;
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
            ->with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('status', Product::STATUS_AVAILABLE)
            ->whereKeyNot($product->id)
            ->when($product->category_id, function ($query) use ($product): void {
                $query->orderByRaw('CASE WHEN category_id = ? THEN 0 ELSE 1 END', [$product->category_id]);
            })
            ->latest('id')
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
    ): RedirectResponse|JsonResponse {
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

        $browserMetaEvent = array_merge($metaEvent, [
            'email' => $lead->email,
            'phone' => $lead->phone,
            'customer_name' => $lead->name,
            'fbp' => $lead->fbp,
            'fbc' => $lead->fbc,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Thank you! Your quote request has been sent successfully.',
                'meta_event' => $browserMetaEvent,
            ]);
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Thank you! Your quote request has been sent successfully.')
            ->with('meta_event', $browserMetaEvent);
    }
}
