@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Checkout</h1>
<form method="post" action="{{ route('checkout.pay') }}" class="space-y-3">
    @csrf
    <textarea name="shipping_address" class="w-full border rounded p-2" placeholder="Shipping address"></textarea>
    <button class="rounded bg-indigo-600 text-white px-4 py-2">Pay with Razorpay</button>
</form>
@endsection
