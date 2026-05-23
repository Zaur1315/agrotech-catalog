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

        $featuredProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(6)
            ->get();

        $latestProducts = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->latest()
            ->limit(6)
            ->get();

        return view('front.home.index', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'latestProducts' => $latestProducts,
        ]);
    }
}
