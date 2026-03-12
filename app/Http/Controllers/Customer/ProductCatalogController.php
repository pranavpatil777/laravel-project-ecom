<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    public function __construct(private readonly CatalogService $catalogService)
    {
    }

    public function index(Request $request): View
    {
        $products = $this->catalogService->search($request->only(['search', 'category_id']));

        return view('customer.catalog', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();

        return view('customer.product', compact('product'));
    }
}
