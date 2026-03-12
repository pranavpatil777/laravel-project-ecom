@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Cart</h1>
@foreach($items as $item)
<div class="flex justify-between bg-white border rounded p-3 mb-2">
    <span>{{ $item->name }} x {{ $item->qty }}</span>
    <div class="flex gap-3">
        <span>₹{{ $item->price }}</span>
        <form method="post" action="{{ route('cart.destroy', $item->rowId) }}">@csrf @method('DELETE')<button>Remove</button></form>
    </div>
</div>
@endforeach
<p class="font-semibold mt-4">Total: ₹{{ $total }}</p>
<a class="inline-block mt-3 rounded bg-black text-white px-4 py-2" href="{{ route('checkout.index') }}">Checkout</a>
@endsection
