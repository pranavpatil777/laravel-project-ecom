<?php

namespace App\Services;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    public function addProduct(Product $product, int $qty = 1): void
    {
        Cart::add($product->id, $product->name, $qty, $product->price);
    }

    public function content()
    {
        return Cart::content();
    }

    public function remove(string $rowId): void
    {
        Cart::remove($rowId);
    }

    public function total(): string
    {
        return Cart::total(2, '.', '');
    }
}
