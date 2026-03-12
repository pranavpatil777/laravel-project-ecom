<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Ecom') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900" x-data="{ open: false }">
<nav class="border-b bg-white p-4 flex justify-between">
    <a href="{{ route('catalog.index') }}" class="font-bold">Ecom</a>
    <div class="space-x-3">
        <a href="{{ route('wishlist.index') }}">Wishlist</a>
        <a href="{{ route('cart.index') }}">Cart</a>
    </div>
</nav>
<main class="max-w-6xl mx-auto p-6">
    @if(session('status'))
        <div class="mb-4 rounded bg-green-100 p-2">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
