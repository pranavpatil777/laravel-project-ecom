<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class CheckoutService
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly CouponService $couponService,
    ) {
    }

    public function createOrder(array $payload): Order
    {
        return DB::transaction(function () use ($payload) {
            $subtotal = $this->cartService->subtotal();
            $discount = $this->couponService->calculateDiscount($payload['coupon_code'] ?? null, $subtotal);
            $total = max(0, $subtotal - $discount);

            $order = Order::query()->create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'discount_total' => $discount,
                'total' => $total,
                'coupon_code' => $payload['coupon_code'] ?? null,
                'shipping_address' => $payload['shipping_address'],
                'payment_gateway' => 'razorpay',
            ]);

            foreach ($this->cartService->content() as $item) {
                $product = Product::query()->findOrFail($item->id);

                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'line_total' => $item->qty * $item->price,
                ]);

                $product->decrement('stock', $item->qty);
            }

            $this->cartService->clear();

            return $order;
        });
    }

    public function createRazorpayOrder(Order $order): array
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        return $api->order->create([
            'receipt' => (string) $order->id,
            'amount' => (int) round($order->total * 100),
            'currency' => 'INR',
        ])->toArray();
    }
}
