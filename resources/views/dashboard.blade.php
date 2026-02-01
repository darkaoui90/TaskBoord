<x-app-layout>
    <div class="bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Dashboard</h1>
                <p class="mt-2 text-sm text-slate-500">Apercu de vos taches et statistiques</p>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $total }}</p>
                    <p class="text-sm text-slate-500">Total des taches</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 7v5l3 3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $todo }}</p>
                    <p class="text-sm text-slate-500">A faire</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 17l6-6 4 4 6-8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 17h16" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $inProgress }}</p>
                    <p class="text-sm text-slate-500">En cours</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 12l2.5 2.5L16 9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $done }}</p>
                    <p class="text-sm text-slate-500">Terminees</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 8v5M12 16h.01" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-semibold text-slate-900">{{ $overdue }}</p>
                    <p class="text-sm text-slate-500">En retard</p>
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-base font-semibold text-slate-900">Taux de completion</p>
                    <p class="text-lg font-semibold text-indigo-600">{{ $completion }}%</p>
                </div>
                <div class="mt-4 h-3 w-full rounded-full bg-slate-200">
                    <div class="h-3 rounded-full bg-indigo-600" style="width: {{ $completion }}%"></div>
                </div>
                <p class="mt-3 text-sm text-slate-500">{{ $done }} tache terminee sur {{ $total }}</p>
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-base font-semibold text-slate-900">Actions rapides</p>
                <div class="mt-4 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <a href="{{ route('search') }}" class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-5 text-center transition hover:border-indigo-200 hover:bg-indigo-50">
                        <p class="text-sm font-semibold text-slate-900">Creer une tache</p>
                        <p class="mt-1 text-sm text-slate-500">Ajouter une nouvelle tache</p>
                    </a>
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-5 text-center">
                        <p class="text-sm font-semibold text-slate-900">Creer plusieurs taches</p>
                        <p class="mt-1 text-sm text-slate-500">Ajout en masse</p>
                    </div>
                    <a href="{{ route('Tasks') }}" class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-5 text-center transition hover:border-indigo-200 hover:bg-indigo-50">
                        <p class="text-sm font-semibold text-slate-900">Voir toutes les taches</p>
                        <p class="mt-1 text-sm text-slate-500">Liste complete</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
