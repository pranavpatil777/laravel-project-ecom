@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Cart</h1>
@forelse($items as $item)
<div class="flex justify-between bg-white border rounded p-3 mb-2">
    <span>{{ $item->name }} x {{ $item->qty }}</span>
    <div class="flex gap-3">
        <span>₹{{ number_format($item->price, 2) }}</span>
        <form method="post" action="{{ route('cart.destroy', $item->rowId) }}">@csrf @method('DELETE')<button>Remove</button></form>
    </div>
</div>
@empty
<p>Your cart is empty.</p>
@endforelse
<p class="font-semibold mt-4">Subtotal: ₹{{ number_format($subtotal, 2) }}</p>
@if($items->count())
<a class="inline-block mt-3 rounded bg-black text-white px-4 py-2" href="{{ route('checkout.index') }}">Checkout</a>
@endif
@endsection
