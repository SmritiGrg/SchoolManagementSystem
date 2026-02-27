
@extends('layouts.main')
@section('container')
  <div class="min-h-full flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-5xl">
      <!-- Header -->
      <div class="text-center mb-12 mt-16">
        <h1 class="text-3xl sm:text-4xl font-bold mb-3 bg-linear-to-r from-white to-slate-400 bg-clip-text text-transparent">
          Welcome Back
        </h1>
        <p class="text-slate-400 text-lg">Choose your role to continue</p>
      </div>

      <!-- Login Cards -->
      <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
        <!-- Teacher Login Card -->
        <a href="{{ route('login.form', ['role' => 'teacher']) }}" class="card-hover block">
          <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50 text-center">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <h2 class="text-2xl font-bold mb-3">Teacher Login</h2>
            <p class="text-slate-400 mb-6">Access your classes, manage grades, and track student progress</p>
            <div class="inline-flex items-center gap-2 text-blue-400 font-semibold">
              Continue as Teacher
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </div>
        </a>

        <!-- Student Login Card -->
        <a href="{{ route('login.form', ['role' => 'student']) }}" class="card-hover block">
          <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50 text-center">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <h2 class="text-2xl font-bold mb-3">Student Login</h2>
            <p class="text-slate-400 mb-6">View your courses, check grades, and access learning materials</p>
            <div class="inline-flex items-center gap-2 text-emerald-400 font-semibold">
              Continue as Student
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </div>
        </a>
      </div>

      <!-- Back to Home -->
      <div class="text-center mt-8">
        <a href="/" class="text-slate-400 hover:text-white transition-colors text-sm">
          ← Back to Home
        </a>
      </div>
    </div>
  </div>
@endsection
