@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Admin Product Management</h1>
<table class="w-full bg-white border">
    <thead><tr><th class="p-2 text-left">Name</th><th class="p-2 text-left">Category</th><th class="p-2 text-left">Stock</th></tr></thead>
    <tbody>
    @foreach($products as $product)
        <tr class="border-t"><td class="p-2">{{ $product->name }}</td><td class="p-2">{{ $product->category?->name }}</td><td class="p-2">{{ $product->stock }}</td></tr>
    @endforeach
    </tbody>
</table>
@endsection
