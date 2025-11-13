<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Auth - Sun Rise Clinic')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:Manrope,system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;background-color:#f6f8f6}</style>
  </head>
  <body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6">
      <div class="text-center mb-6">
        <h1 class="text-2xl font-extrabold">Sun Rise Clinic</h1>
        <p class="text-sm text-slate-600">Clinic scheduling & patient management</p>
      </div>

      <div class="bg-white rounded-lg shadow px-6 py-6">
        @if(session('status'))
          <div class="mb-4 text-sm text-green-700 bg-green-50 p-3 rounded">{{ session('status') }}</div>
        @endif

        @yield('content')
      </div>

      <p class="mt-4 text-center text-xs text-slate-500">© {{ date('Y') }} Sun Rise Clinic</p>
    </div>
  </body>
</html>