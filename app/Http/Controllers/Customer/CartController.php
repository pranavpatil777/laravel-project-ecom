<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService)
    {
    }

    public function index(): View
    {
        return view('customer.cart', [
            'items' => $this->cartService->content(),
            'total' => $this->cartService->total(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::query()->findOrFail($request->integer('product_id'));
        $this->cartService->addProduct($product, max(1, $request->integer('qty', 1)));

        return back()->with('status', 'Product added to cart');
    }

    public function destroy(string $rowId): RedirectResponse
    {
        $this->cartService->remove($rowId);

        return back()->with('status', 'Product removed');
    }
}
