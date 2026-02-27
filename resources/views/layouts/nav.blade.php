
    <body class="h-full gradient-bg text-white overflow-auto">
        @flasher_render
        <div class="w-full min-h-full"><!-- Navigation -->
            <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-slate-900/70 border-b border-slate-700/50">
                <div class="max-w-7xl mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-linear-to-br from-blue-500 to-cyan-400 flex items-center justify-center pulse-glow">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div><span class="text-xl font-bold bg-linear-to-r from-white to-slate-300 bg-clip-text text-transparent">EduFlow</span>
                        </div>
                    <div class="hidden md:flex items-center gap-8"><a href="#features" class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Features</a> <a href="#stats" class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Results</a> <a href="#testimonials" class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Testimonials</a> <a href="#pricing" class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Pricing</a>
                </div>
                <div class="flex items-center gap-4"><a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition-colors text-sm font-medium hidden sm:block">Log In</a> <button id="nav-cta" class="px-5 py-2.5 bg-linear-to-r from-blue-600 to-cyan-500 rounded-lg font-semibold text-sm hover:from-blue-500 hover:to-cyan-400 transition-all shadow-lg shadow-blue-500/25"> Get Started </button>
                </div>
                </div>
                </div>
            </nav><!-- Hero Section -->