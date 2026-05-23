<?php
declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        return $this->renderCatalog($request);
    }

    public function category(Request $request, Category $category): View
    {
        abort_if(!$category->is_active, 404);

        return $this->renderCatalog($request, $category);
    }

    private function renderCatalog(Request $request, ?Category $currentCategory = null): View
    {
        $query = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true);

        if ($currentCategory !== null) {
            $query->where('category_id', $currentCategory->id);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', (int)$request->integer('brand'));
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->string('condition')->toString());
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float)$request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float)$request->input('max_price'));
        }

        if ($request->filled('year_from')) {
            $query->where('year', '>=', (int)$request->integer('year_from'));
        }

        if ($request->filled('year_to')) {
            $query->where('year', '<=', (int)$request->integer('year_to'));
        }

        $sort = $request->string('sort')->toString();

        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'year_desc' => $query->orderByDesc('year'),
            'year_asc' => $query->orderBy('year'),
            default => $query->latest(),
        };

        $products = $query
            ->paginate(9)
            ->withQueryString();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('front.catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'currentCategory' => $currentCategory,
            'filters' => $request->query(),
        ]);
    }
}
