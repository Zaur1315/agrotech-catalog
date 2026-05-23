<?php
declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreQuoteCartLeadRequest;
use App\Models\Product;
use App\Services\Cart\QuoteCartService;
use App\Services\Lead\ProductLeadService;
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
        abort_if(!$product->is_active, 404);

        $cart->add($product);

        return back()->with('success', 'Equipment added to quote list.');
    }

    public function remove(Product $product, QuoteCartService $cart): RedirectResponse
    {
        $cart->remove($product->id);

        return back()->with('success', 'Equipment removed from quote list.');
    }

    public function submit(
        StoreQuoteCartLeadRequest $request,
        QuoteCartService          $cart,
        ProductLeadService        $leadService,
    ): RedirectResponse
    {
        $items = $cart->items();

        if ($items->isEmpty()) {
            return redirect()
                ->route('quote.index')
                ->with('error', 'Your quote list is empty.');
        }

        $leadService->createFromQuoteCart($items, $request->validated());

        $cart->clear();

        return redirect()
            ->route('quote.index')
            ->with('success', 'Thank you! Your quote request has been sent successfully.');
    }
}
