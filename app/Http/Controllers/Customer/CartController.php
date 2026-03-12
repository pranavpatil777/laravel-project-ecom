<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RuntimeException;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService)
    {
    }

    public function index(): View
    {
        return view('customer.cart', [
            'items' => $this->cartService->content(),
            'subtotal' => $this->cartService->subtotal(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['product_id' => ['required', 'integer'], 'qty' => ['nullable', 'integer', 'min:1']]);
        $product = Product::query()->findOrFail($request->integer('product_id'));

        try {
            $this->cartService->addProduct($product, $request->integer('qty', 1));
        } catch (RuntimeException $exception) {
            return back()->with('status', $exception->getMessage());
        }

        return back()->with('status', 'Product added to cart');
    }

    public function destroy(string $rowId): RedirectResponse
    {
        $this->cartService->remove($rowId);

        return back()->with('status', 'Product removed');
    }
}
