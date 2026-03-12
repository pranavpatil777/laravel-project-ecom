<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(private readonly CheckoutService $checkoutService)
    {
    }

    public function index(): View
    {
        return view('customer.checkout');
    }

    public function pay(Request $request): RedirectResponse
    {
        $order = $this->checkoutService->createOrder($request->validate([
            'shipping_address' => ['required', 'string', 'max:500'],
            'coupon_code' => ['nullable', 'string', 'max:50'],
        ]));

        $gatewayOrder = $this->checkoutService->createRazorpayOrder($order);

        $order->update(['payment_reference' => $gatewayOrder['id']]);

        return redirect()->route('orders.track', $order)->with('gateway_order_id', $gatewayOrder['id']);
    }

    public function track(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('customer.track-order', compact('order'));
    }
}
