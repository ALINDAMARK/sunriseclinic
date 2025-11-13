@extends('auth.layout')

@section('title','Verify your email')

@section('content')
  <h2 class="text-lg font-semibold mb-4">Verify your email</h2>

  <p class="mb-4 text-sm text-slate-600">Thanks for registering — before continuing please check your email for a verification link. If you didn't receive the email, use the button below to resend.</p>

  @if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <div>
      <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700">Resend verification email</button>
    </div>
  </form>

  <div class="mt-4 text-sm text-slate-600">Once verified you'll be able to use all features.</div>
@endsection
