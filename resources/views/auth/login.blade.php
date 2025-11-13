@extends('auth.layout')

@section('title','Log in')

@section('content')
  <h2 class="text-lg font-semibold mb-4">Sign in to your account</h2>

  @if($errors->any())
    <div class="mb-4 text-sm text-red-700 bg-red-50 p-3 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full mt-1 rounded border px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="w-full mt-1 rounded border px-3 py-2" />
      </div>
      <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remember" class="rounded"> Remember me</label>
        @if(Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">Forgot password?</a>
        @endif
      </div>

      <div>
        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700">Sign in</button>
      </div>

      <div class="text-center text-sm text-slate-600">Don't have an account? <a href="{{ route('register') }}" class="text-green-600 hover:underline">Create one</a></div>
    </div>
  </form>
@endsection