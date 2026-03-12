@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold">{{ $product->name }}</h1>
<p class="text-gray-600 mt-2">{{ $product->description }}</p>
<p class="mt-2">₹{{ $product->price }}</p>
<div class="mt-3 flex gap-4">
    <form method="post" action="{{ route('cart.store') }}">@csrf <input type="hidden" name="product_id" value="{{ $product->id }}"><button class="rounded border px-3 py-1">Add to cart</button></form>
    @auth
    <form method="post" action="{{ route('wishlist.store', $product) }}">@csrf<button class="rounded border px-3 py-1">Add to wishlist</button></form>
    @endauth
</div>
@endsection
