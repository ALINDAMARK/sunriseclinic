@extends('auth.layout')

@section('title','Create account')

@section('content')
  <h2 class="text-lg font-semibold mb-4">Create your account</h2>

  @if($errors->any())
    <div class="mb-4 text-sm text-red-700 bg-red-50 p-3 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Full name</label>
        <input name="name" value="{{ old('name') }}" required class="w-full mt-1 rounded border px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="w-full mt-1 rounded border px-3 py-2" />
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium">Password</label>
          <input type="password" name="password" required class="w-full mt-1 rounded border px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Confirm</label>
          <input type="password" name="password_confirmation" required class="w-full mt-1 rounded border px-3 py-2" />
        </div>
      </div>

      <div>
        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700">Create account</button>
      </div>

      <div class="text-center text-sm text-slate-600">Already have an account? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Sign in</a></div>
    </div>
  </form>
@endsection