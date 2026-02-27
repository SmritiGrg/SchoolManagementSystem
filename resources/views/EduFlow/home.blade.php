@extends('layouts.main')
@section('container')
   <section class="relative pt-32 pb-20 px-6 hero-gradient overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
     <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
     <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto relative">
     <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="fade-in">
       <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-6"><span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> <span class="text-sm text-blue-300 font-medium">Trusted by 2,500+ Schools Worldwide</span>
       </div>
       <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6"><span class="bg-gradient-to-r from-white via-slate-200 to-slate-400 bg-clip-text text-transparent">Transform Your School</span> <br><span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Management Today</span></h1>
       <p id="hero-subtitle" class="text-lg text-slate-400 mb-8 max-w-xl leading-relaxed">The all-in-one platform that simplifies administration, enhances learning, and connects your entire school community seamlessly.</p>
       <div class="flex flex-col sm:flex-row gap-4"><button id="hero-cta" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-bold text-lg hover:from-blue-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-500/30 flex items-center justify-center gap-2"> Get Started Free 
         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
         </svg></button> <button class="px-8 py-4 bg-slate-800/50 border border-slate-700 rounded-xl font-semibold text-lg hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
         <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewbox="0 0 24 24"><path d="M8 5v14l11-7z" />
         </svg> Watch Demo </button>
       </div>
       <div class="flex items-center gap-6 mt-10">
        <div class="flex -space-x-3">
         <div class="w-10 h-10 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 border-2 border-slate-900 flex items-center justify-center text-xs font-bold">
          JD
         </div>
         <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 border-2 border-slate-900 flex items-center justify-center text-xs font-bold">
          MK
         </div>
         <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 border-2 border-slate-900 flex items-center justify-center text-xs font-bold">
          AS
         </div>
         <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 border-2 border-slate-900 flex items-center justify-center text-xs font-bold">
          +5k
         </div>
        </div>
        <div class="text-sm">
         <div class="flex items-center gap-1 text-amber-400">
          ★★★★★ <span class="text-slate-400 ml-1">4.9/5</span>
         </div><span class="text-slate-500">from 5,000+ reviews</span>
        </div>
       </div>
      </div><!-- Dashboard Preview -->
      <div class="relative fade-in stagger-2 hidden lg:block">
       <div class="float-animation">
        <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6 shadow-2xl">
         <div class="flex items-center gap-2 mb-4">
          <div class="w-3 h-3 rounded-full bg-red-400"></div>
          <div class="w-3 h-3 rounded-full bg-amber-400"></div>
          <div class="w-3 h-3 rounded-full bg-green-400"></div>
         </div>
         <div class="space-y-4">
          <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl">
           <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
             <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
             </svg>
            </div>
            <div>
             <div class="text-sm font-semibold">
              Total Students
             </div>
             <div class="text-xs text-slate-400">
              Active enrollment
             </div>
            </div>
           </div>
           <div class="text-2xl font-bold text-blue-400">
            2,847
           </div>
          </div>
          <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl">
           <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center">
             <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
            </div>
            <div>
             <div class="text-sm font-semibold">
              Attendance Rate
             </div>
             <div class="text-xs text-slate-400">
              This semester
             </div>
            </div>
           </div>
           <div class="text-2xl font-bold text-emerald-400">
            94.2%
           </div>
          </div>
          <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl">
           <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-violet-500/20 flex items-center justify-center">
             <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
             </svg>
            </div>
            <div>
             <div class="text-sm font-semibold">
              Avg. Performance
             </div>
             <div class="text-xs text-slate-400">
              Grade improvement
             </div>
            </div>
           </div>
           <div class="text-2xl font-bold text-violet-400">
            +12%
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Logos Section -->
   <section class="py-12 px-6 border-y border-slate-800">
    <div class="max-w-7xl mx-auto">
     <p class="text-center text-slate-500 text-sm mb-8">TRUSTED BY LEADING EDUCATIONAL INSTITUTIONS</p>
     <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60">
      <div class="text-xl font-bold text-slate-400">
       Harvard Prep
      </div>
      <div class="text-xl font-bold text-slate-400">
       Lincoln Academy
      </div>
      <div class="text-xl font-bold text-slate-400">
       St. Mary's
      </div>
      <div class="text-xl font-bold text-slate-400">
       Tech High
      </div>
      <div class="text-xl font-bold text-slate-400">
       Greenwood
      </div>
     </div>
    </div>
   </section><!-- Features Section -->
   <section id="features" class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16"><span class="text-blue-400 font-semibold text-sm uppercase tracking-wider">Powerful Features</span>
      <h2 id="features-title" class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-6 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Everything You Need to Run Your School</h2>
      <p class="text-slate-400 text-lg max-w-2xl mx-auto">From admissions to alumni management, EduFlow provides comprehensive tools designed specifically for modern educational institutions.</p>
     </div>
     <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6"><!-- Feature Card 1 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Student Management</h3>
       <p class="text-slate-400 leading-relaxed">Complete student profiles, enrollment tracking, and academic history all in one centralized system.</p>
      </div><!-- Feature Card 2 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Attendance Tracking</h3>
       <p class="text-slate-400 leading-relaxed">Automated attendance with real-time notifications to parents and detailed analytics for administrators.</p>
      </div><!-- Feature Card 3 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center mb-6 shadow-lg shadow-violet-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Grade Management</h3>
       <p class="text-slate-400 leading-relaxed">Comprehensive gradebook with customizable grading scales, report cards, and performance analytics.</p>
      </div><!-- Feature Card 4 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Fee Management</h3>
       <p class="text-slate-400 leading-relaxed">Streamlined billing, online payments, automatic reminders, and detailed financial reporting.</p>
      </div><!-- Feature Card 5 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center mb-6 shadow-lg shadow-rose-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Timetable &amp; Scheduling</h3>
       <p class="text-slate-400 leading-relaxed">Smart scheduling for classes, exams, and events with conflict detection and resource allocation.</p>
      </div><!-- Feature Card 6 -->
      <div class="card-hover p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-6 shadow-lg shadow-cyan-500/30">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
       </div>
       <h3 class="text-xl font-bold mb-3">Communication Hub</h3>
       <p class="text-slate-400 leading-relaxed">Unified messaging for teachers, parents, and students with announcements and notification center.</p>
      </div>
     </div>
    </div>
   </section><!-- Stats Section -->
   <section id="stats" class="py-24 px-6 bg-slate-800/30">
    <div class="max-w-7xl mx-auto">
     <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center p-8">
       <div class="text-5xl font-extrabold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-2">
        2,500+
       </div>
       <div class="text-slate-400 font-medium">
        Schools Worldwide
       </div>
      </div>
      <div class="text-center p-8">
       <div class="text-5xl font-extrabold bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent mb-2">
        5M+
       </div>
       <div class="text-slate-400 font-medium">
        Students Managed
       </div>
      </div>
      <div class="text-center p-8">
       <div class="text-5xl font-extrabold bg-gradient-to-r from-violet-400 to-purple-400 bg-clip-text text-transparent mb-2">
        99.9%
       </div>
       <div class="text-slate-400 font-medium">
        Uptime Guaranteed
       </div>
      </div>
      <div class="text-center p-8">
       <div class="text-5xl font-extrabold bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent mb-2">
        40%
       </div>
       <div class="text-slate-400 font-medium">
        Time Saved on Admin
       </div>
      </div>
     </div>
    </div>
   </section><!-- Testimonials -->
   <section id="testimonials" class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16"><span class="text-blue-400 font-semibold text-sm uppercase tracking-wider">Testimonials</span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Loved by Educators Everywhere</h2>
     </div>
     <div class="grid md:grid-cols-3 gap-6">
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="flex items-center gap-1 text-amber-400 mb-4">
        ★★★★★
       </div>
       <p class="text-slate-300 mb-6 leading-relaxed">"EduFlow transformed how we manage our school. Administrative tasks that took hours now take minutes. The parent communication features are a game-changer."</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center font-bold">
         SM
        </div>
        <div>
         <div class="font-semibold">
          Sarah Mitchell
         </div>
         <div class="text-sm text-slate-400">
          Principal, Lincoln Academy
         </div>
        </div>
       </div>
      </div>
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="flex items-center gap-1 text-amber-400 mb-4">
        ★★★★★
       </div>
       <p class="text-slate-300 mb-6 leading-relaxed">"The grade management and analytics have helped us identify struggling students early. Our test scores improved by 15% in the first year of using EduFlow."</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center font-bold">
         JC
        </div>
        <div>
         <div class="font-semibold">
          James Chen
         </div>
         <div class="text-sm text-slate-400">
          Director, Tech High School
         </div>
        </div>
       </div>
      </div>
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <div class="flex items-center gap-1 text-amber-400 mb-4">
        ★★★★★
       </div>
       <p class="text-slate-300 mb-6 leading-relaxed">"As a parent, I love being able to track my child's attendance and grades in real-time. The mobile app makes it so convenient to stay connected with the school."</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-violet-400 to-violet-600 flex items-center justify-center font-bold">
         MR
        </div>
        <div>
         <div class="font-semibold">
          Maria Rodriguez
         </div>
         <div class="text-sm text-slate-400">
          Parent, St. Mary's School
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Pricing Section -->
   <section id="pricing" class="py-24 px-6 bg-slate-800/30">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16"><span class="text-blue-400 font-semibold text-sm uppercase tracking-wider">Pricing</span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-6 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Simple, Transparent Pricing</h2>
      <p class="text-slate-400 text-lg">Choose the plan that fits your institution's needs</p>
     </div>
     <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto"><!-- Starter Plan -->
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <h3 class="text-xl font-bold mb-2">Starter</h3>
       <p class="text-slate-400 text-sm mb-6">Perfect for small schools</p>
       <div class="mb-6"><span class="text-4xl font-extrabold">$49</span> <span class="text-slate-400">/month</span>
       </div>
       <ul class="space-y-3 mb-8">
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Up to 500 students</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Basic reporting</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Email support</li>
       </ul><button class="w-full py-3 border border-slate-600 rounded-xl font-semibold hover:bg-slate-700 transition-colors"> Get Started </button>
      </div><!-- Professional Plan -->
      <div class="p-8 bg-gradient-to-b from-blue-600/20 to-slate-800/40 backdrop-blur-sm rounded-2xl border border-blue-500/30 relative">
       <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full text-sm font-semibold">
        Most Popular
       </div>
       <h3 class="text-xl font-bold mb-2">Professional</h3>
       <p class="text-slate-400 text-sm mb-6">For growing institutions</p>
       <div class="mb-6"><span class="text-4xl font-extrabold">$149</span> <span class="text-slate-400">/month</span>
       </div>
       <ul class="space-y-3 mb-8">
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Up to 2,000 students</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Advanced analytics</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Priority support</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Mobile apps</li>
       </ul><button class="w-full py-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-semibold hover:from-blue-500 hover:to-cyan-400 transition-all shadow-lg shadow-blue-500/30"> Get Started </button>
      </div><!-- Enterprise Plan -->
      <div class="p-8 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50">
       <h3 class="text-xl font-bold mb-2">Enterprise</h3>
       <p class="text-slate-400 text-sm mb-6">For large districts</p>
       <div class="mb-6"><span class="text-4xl font-extrabold">Custom</span>
       </div>
       <ul class="space-y-3 mb-8">
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Unlimited students</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Custom integrations</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> Dedicated support</li>
        <li class="flex items-center gap-3 text-slate-300">
         <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
         </svg> SLA guarantee</li>
       </ul><button class="w-full py-3 border border-slate-600 rounded-xl font-semibold hover:bg-slate-700 transition-colors"> Contact Sales </button>
      </div>
     </div>
    </div>
   </section><!-- CTA Section -->
   <section class="py-24 px-6">
    <div class="max-w-4xl mx-auto text-center">
     <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6 bg-gradient-to-r from-white via-slate-200 to-slate-400 bg-clip-text text-transparent">Ready to Transform Your School?</h2>
     <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">Join thousands of schools already using EduFlow to streamline operations and improve student outcomes.</p>
     <div class="flex flex-col sm:flex-row gap-4 justify-center"><button class="px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-xl font-bold text-lg hover:from-blue-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-500/30"> Start Free Trial </button> <button class="px-8 py-4 bg-slate-800/50 border border-slate-700 rounded-xl font-semibold text-lg hover:bg-slate-800 transition-all"> Schedule Demo </button>
     </div>
    </div>
   </section>
   
   @endsection