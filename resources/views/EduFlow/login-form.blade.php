@extends('layouts.main')
@section('container')
  <div class="min-h-full flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <!-- Header -->
      <div class="text-center mb-8 mt-16">
        <h1 class="text-3xl font-bold mb-2 bg-linear-to-r from-white to-slate-400 bg-clip-text text-transparent">
          {{ ucfirst($role) }} Login
        </h1>
        <p class="text-slate-400">Enter your credentials to continue</p>
      </div>

      <!-- Login Form -->
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
        @if (session('login_error'))
          <div class="mb-4 rounded-lg border border-red-500/30 bg-red-500/15 px-4 py-3 text-red-200">
            {{ session('login_error') }}
          </div>
        @endif
        {{-- <pre class="text-white">
          {{ print_r(session()->all(), true) }}
          </pre> --}}
        <form method="POST" action="{{ route('login.submit') }}">
          @csrf
          <input type="hidden" name="role" value="{{ $role }}">

          <!-- Email -->
          <div class="mb-6">
            <label for="email" class="block text-sm font-semibold mb-2">Email Address</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              value="{{ old('email') }}" 
              autofocus
              class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400"
              placeholder="Enter your email"
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
              class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400"
              placeholder="Enter your password"
            >
            @error('password')
              <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between mb-6">
            <label class="flex items-center">
              <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 bg-slate-700/50 text-blue-500 focus:ring-2 focus:ring-blue-500">
              <span class="ml-2 text-sm text-slate-300">Remember me</span>
            </label>
            <a href="#" class="text-sm text-blue-400 hover:text-blue-300">Forgot password?</a>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit"
            class="w-full py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-lg font-semibold hover:from-blue-500 hover:to-cyan-400 transition-all shadow-lg shadow-blue-500/30"
          >
            Sign In
          </button>
        </form>
      </div>

      <!-- Back Link -->
      <div class="text-center mt-6">
        <a href="/login" class="text-slate-400 hover:text-white transition-colors text-sm">
          ← Choose different role
        </a>
      </div>
    </div>
  </div>
@endsection
