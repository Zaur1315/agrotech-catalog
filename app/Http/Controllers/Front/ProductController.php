<?php
declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreProductLeadRequest;
use App\Models\Product;
use App\Services\Lead\ProductLeadService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ProductController extends Controller
{
    public function show(Product $product): View
    {
        abort_if(!$product->is_active, 404);

        $product->load([
            'category',
            'brand',
            'images',
            'specifications',
        ]);

        $relatedProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('front.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function quote(
        StoreProductLeadRequest $request,
        Product                 $product,
        ProductLeadService      $leadService,
    ): RedirectResponse
    {
        abort_if(!$product->is_active, 404);

        $leadService->createFromProduct($product, $request->validated());

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Thank you! Your quote request has been sent successfully.');
    }
}
