<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $availableProductsCount = Product::query()
            ->where('is_active', true)
            ->where('status', Product::STATUS_AVAILABLE)
            ->count();

        $featuredProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('status', Product::STATUS_AVAILABLE)
            ->where('is_featured', true)
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $latestProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('status', Product::STATUS_AVAILABLE)
            ->whereNotIn('id', $featuredProducts->pluck('id'))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(6)
            ->get();

        return view('front.home.index', [
            'categories' => $categories,
            'availableProductsCount' => $availableProductsCount,
            'featuredProducts' => $featuredProducts,
            'latestProducts' => $latestProducts,
        ]);
    }
}
