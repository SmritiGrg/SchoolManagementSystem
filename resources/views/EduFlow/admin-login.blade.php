<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - EduFlow</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/asset/css/style.css">
  @flasher_render
</head>
<body class="h-full gradient-bg text-white">
  <div class="min-h-full flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="flex items-center justify-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center pulse-glow">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <span class="text-2xl font-bold">EduFlow</span>
        </div>
        <h1 class="text-3xl font-bold mb-2 bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent">
          Admin Access
        </h1>
        <p class="text-slate-400">Secure administrator login</p>
      </div>

      <!-- Login Form -->
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-amber-500/30">

        @if (session('login_error'))
          <div class="mb-4 rounded-lg border border-red-500/35 bg-red-500/25 px-4 py-3 text-red-200">
            {{ session('login_error') }}
          </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
          @csrf

          <!-- Email -->
          <div class="mb-6">
            <label for="email" class="block text-sm font-semibold mb-2">Email Address</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              value="{{ old('email') }}" 
              autofocus
              class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-white placeholder-slate-400"
              placeholder="Enter admin email"
            >
            @error('email')
              <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-6">
            <label for="password" class="block text-sm font-semibold mb-2">Password</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-white placeholder-slate-400"
              placeholder="Enter admin password"
            >
            @error('password')
              <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between mb-6">
            <label class="flex items-center">
              <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 bg-slate-700/50 text-amber-500 focus:ring-2 focus:ring-amber-500">
              <span class="ml-2 text-sm text-slate-300">Remember me</span>
            </label>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit"
            class="w-full py-3 bg-gradient-to-r from-amber-600 to-orange-500 rounded-lg font-semibold hover:from-amber-500 hover:to-orange-400 transition-all shadow-lg shadow-amber-500/30"
          >
            Sign In as Admin
          </button>
        </form>

        <!-- Security Notice -->
        <div class="mt-6 p-3 bg-amber-500/10 border border-amber-500/20 rounded-lg">
          <div class="flex items-start gap-2">
            <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-xs text-amber-300">This is a restricted area. All access attempts are logged and monitored.</p>
          </div>
        </div>
      </div>

      <!-- Back Link -->
      <div class="text-center mt-6">
        <a href="/" class="text-slate-400 hover:text-white transition-colors text-sm">
          ← Back to Home
        </a>
      </div>
    </div>
  </div>
</body>
</html>
