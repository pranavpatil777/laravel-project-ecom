@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Order #{{ $order->id }}</h1>
<p class="mt-2">Status: {{ ucfirst($order->status) }}</p>
<p>Total: ₹{{ $order->total }}</p>
@endsection
