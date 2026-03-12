@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Register</h1>
<form method="post" action="{{ route('register') }}" class="space-y-3 max-w-md">
    @csrf
    <input name="name" placeholder="Name" class="w-full rounded border p-2" required>
    <input name="email" type="email" placeholder="Email" class="w-full rounded border p-2" required>
    <input name="password" type="password" placeholder="Password" class="w-full rounded border p-2" required>
    <input name="password_confirmation" type="password" placeholder="Confirm password" class="w-full rounded border p-2" required>
    <button class="rounded bg-black text-white px-4 py-2">Create account</button>
</form>
@endsection
