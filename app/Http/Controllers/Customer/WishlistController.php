<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $wishlist = auth()->user()?->wishlistProducts()->latest()->get() ?? collect();

        return view('customer.wishlist', compact('wishlist'));
    }

    public function store(Product $product): RedirectResponse
    {
        auth()->user()?->wishlistProducts()->syncWithoutDetaching([$product->id]);

        return back()->with('status', 'Saved to wishlist');
    }
}
