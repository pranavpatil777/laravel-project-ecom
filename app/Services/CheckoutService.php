<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class CheckoutService
{
    public function __construct(
        private readonly CartService $cartService
    ) {
    }

    public function createOrder(array $payload): Order
    {
        return DB::transaction(function () use ($payload) {
            $order = Order::query()->create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'total' => $this->cartService->total(),
                'shipping_address' => $payload['shipping_address'],
            ]);

            foreach ($this->cartService->content() as $item) {
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
            }

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
