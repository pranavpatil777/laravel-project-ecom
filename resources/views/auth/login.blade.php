@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Login</h1>
<form method="post" action="{{ route('login') }}" class="space-y-3 max-w-md">
    @csrf
    <input name="email" type="email" placeholder="Email" class="w-full rounded border p-2" required>
    <input name="password" type="password" placeholder="Password" class="w-full rounded border p-2" required>
    <label class="inline-flex items-center gap-2"><input name="remember" type="checkbox"> Remember me</label>
    <button class="rounded bg-black text-white px-4 py-2">Login</button>
</form>
@endsection
