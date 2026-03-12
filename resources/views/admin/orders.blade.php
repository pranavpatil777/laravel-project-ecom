@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Admin Order Management</h1>
<table class="w-full bg-white border">
    <thead><tr><th class="p-2 text-left">Order</th><th class="p-2 text-left">Status</th><th class="p-2 text-left">Total</th></tr></thead>
    <tbody>
    @foreach($orders as $order)
        <tr class="border-t"><td class="p-2">#{{ $order->id }}</td><td class="p-2">{{ $order->status }}</td><td class="p-2">₹{{ $order->total }}</td></tr>
    @endforeach
    </tbody>
</table>
@endsection
