@extends('layouts.app')

@section('content')
<form class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-3">
    <input name="search" value="{{ request('search') }}" placeholder="Search products" class="rounded border p-2">
    <button class="rounded bg-black text-white px-4">Search</button>
</form>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($products as $product)
        <article class="bg-white rounded border p-4">
            <h2 class="font-semibold">{{ $product->name }}</h2>
            <p class="text-sm text-gray-500">₹{{ $product->price }}</p>
            <div class="mt-3 flex gap-2">
                <a href="{{ route('catalog.show', $product->slug) }}" class="text-blue-600">View</a>
                <form method="post" action="{{ route('cart.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="text-green-700">Add to cart</button>
                </form>
            </div>
        </article>
    @endforeach
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
