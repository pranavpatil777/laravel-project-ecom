@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Wishlist</h1>
@forelse($wishlist as $product)
<div class="bg-white border rounded p-3 mb-2">{{ $product->name }}</div>
@empty
<p>No wishlist items yet.</p>
@endforelse
@endsection
