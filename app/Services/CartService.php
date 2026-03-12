<?php

namespace App\Services;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use RuntimeException;

class CartService
{
    public function addProduct(Product $product, int $qty = 1): void
    {
        if ($product->stock < $qty) {
            throw new RuntimeException('Not enough inventory for this product.');
        }

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

    public function subtotal(): float
    {
        return (float) Cart::subtotal(2, '.', '');
    }

    public function clear(): void
    {
        Cart::destroy();
    }
}
