@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold">{{ $product->name }}</h1>
<p class="text-gray-600 mt-2">{{ $product->description }}</p>
<p class="mt-2">₹{{ $product->price }}</p>
<form method="post" action="{{ route('wishlist.store', $product) }}" class="mt-3">@csrf<button class="rounded border px-3 py-1">Add to wishlist</button></form>
@endsection
