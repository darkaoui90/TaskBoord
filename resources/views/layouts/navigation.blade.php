<nav class="bg-white border-b border-slate-200">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 py-5">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="10" cy="10" r="8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.5 10.5l2.5 2.5L14 7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold text-slate-900">TaskBoard</span>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} inline-flex items-center gap-2 rounded-lg px-4 py-2 font-medium">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('Tasks') }}"
                       class="{{ request()->routeIs('Tasks') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} inline-flex items-center gap-2 rounded-lg px-4 py-2 font-medium">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 6h10M4 12h16M4 18h10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 6h2M18 18h2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Mes taches
                    </a>
                    <a href="{{ route('search') }}"
                       class="{{ request()->routeIs('search') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} inline-flex items-center gap-2 rounded-lg px-4 py-2 font-medium">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Nouvelle tache
                    </a>
                </div>

                <div class="flex items-center gap-6 text-slate-600">
                    <div class="text-right">
                        <p class="font-medium text-slate-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">Utilisateur</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg px-3 py-2 font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 17l5-5-5-5M15 12H3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Deconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
