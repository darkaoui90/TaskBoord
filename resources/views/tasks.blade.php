<x-app-layout>
    <div class="bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Mes taches</h1>
                <p class="mt-2 text-sm text-slate-500">{{ $tasks->count() }} tache(s) trouvee(s)</p>
            </div>

            @if (session('success'))
                <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-6 rounded-xl border border-slate-200 bg-indigo-50 px-6 py-4 text-center">
                <a href="{{ route('search') }}" class="text-sm font-semibold text-indigo-600">Nouvelle tache</a>
            </div>

            <div class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="space-y-6">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rechercher</label>
                        <div class="mt-2 flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500">
                            <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 20l-3.5-3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input id="task-search" type="text" class="w-full text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none" placeholder="Rechercher par titre ou description...">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priorite</label>
                        <select id="filter-priority" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700">
                            <option value="">Toutes</option>
                            <option value="low">Basse</option>
                            <option value="medium">Moyenne</option>
                            <option value="high">Haute</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Statut</label>
                        <select id="filter-status" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700">
                            <option value="">Tous</option>
                            <option value="todo">A faire</option>
                            <option value="in_progress">En cours</option>
                            <option value="done">Terminees</option>
                        </select>
                    </div>
                    <div class="border-t border-slate-100 pt-4">
                        <button id="sort-deadline" class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 6l4-4 4 4M16 18l-4 4-4-4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 2v20" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Trier par deadline (Croissant)
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                @php
                    $columns = [
                        'todo' => 'A faire',
                        'in_progress' => 'En cours',
                        'done' => 'Terminees',
                    ];
                @endphp

                @foreach ($columns as $key => $label)
                    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm" data-column="{{ $key }}">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-slate-900">{{ $label }}</h3>
                            <span class="text-xs text-slate-500" data-count>{{ $tasksByStatus[$key]->count() }}</span>
                        </div>
                        <div class="mt-4 min-h-[120px] space-y-4 rounded-lg bg-slate-50 p-3"
                             data-dropzone
                             data-status="{{ $key }}">
                            @forelse ($tasksByStatus[$key] as $task)
                                <div class="cursor-grab rounded-lg border border-slate-200 bg-white p-4 text-sm shadow-sm"
                                     draggable="true"
                                     data-task-id="{{ $task->id }}"
                                     data-title="{{ Str::lower($task->title) }}"
                                     data-description="{{ Str::lower($task->description ?? '') }}"
                                     data-priority="{{ $task->priority }}"
                                     data-status="{{ $task->status }}"
                                     data-deadline="{{ $task->deadline ? $task->deadline->format('Y-m-d') : '' }}">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $task->title }}</p>
                                            @if ($task->description)
                                                <p class="mt-1 text-xs text-slate-500">{{ $task->description }}</p>
                                            @endif
                                        </div>
                                        <div class="flex flex-col items-end gap-2 text-xs text-slate-500">
                                            <span class="rounded-full border border-slate-200 px-2 py-0.5">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                            <select class="rounded border border-slate-200 bg-white px-2 py-1 text-xs text-slate-700"
                                                    data-status-select
                                                    data-task-id="{{ $task->id }}">
                                                <option value="todo" @selected($task->status === 'todo')>A faire</option>
                                                <option value="in_progress" @selected($task->status === 'in_progress')>En cours</option>
                                                <option value="done" @selected($task->status === 'done')>Terminee</option>
                                            </select>
                                            <a href="{{ route('tasks.edit', $task) }}" class="font-semibold text-indigo-600 hover:underline">Modifier</a>
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-semibold text-rose-600 hover:underline" data-delete>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-xs text-slate-500">
                                        Deadline: {{ $task->deadline ? $task->deadline->format('d/m/Y') : 'Aucune' }}
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-lg border border-dashed border-slate-200 px-4 py-6 text-center text-xs text-slate-500"
                                     data-empty>
                                    Aucune tache
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4 flex items-center justify-between text-xs text-slate-500">
                            <button class="rounded px-2 py-1 hover:bg-slate-50" data-page-prev>Precedent</button>
                            <span data-page-indicator>Page 1</span>
                            <button class="rounded px-2 py-1 hover:bg-slate-50" data-page-next>Suivant</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cards = document.querySelectorAll('[data-task-id]');
    const zones = document.querySelectorAll('[data-dropzone]');
    const searchInput = document.querySelector('#task-search');
    const filterPriority = document.querySelector('#filter-priority');
    const filterStatus = document.querySelector('#filter-status');
    const sortButton = document.querySelector('#sort-deadline');

    let sortAsc = true;
    const pageSize = 6;

    const refreshColumnState = (zone) => {
        const column = zone.closest('.rounded-xl');
        const countEl = column?.querySelector('[data-count]');
        const emptyEl = zone.querySelector('[data-empty]');
        const taskCount = zone.querySelectorAll('[data-task-id]:not(.hidden)').length;

        if (countEl) {
            countEl.textContent = taskCount;
        }

        if (emptyEl) {
            emptyEl.classList.toggle('hidden', taskCount > 0);
        }
    };

    const paginateColumn = (column) => {
        const zone = column.querySelector('[data-dropzone]');
        const indicator = column.querySelector('[data-page-indicator]');
        const page = Number(column.dataset.page || '1');
        const visibleCards = Array.from(zone.querySelectorAll('[data-task-id]'))
            .filter((card) => !card.classList.contains('hidden'));

        visibleCards.forEach((card, index) => {
            const start = (page - 1) * pageSize;
            const end = start + pageSize;
            card.classList.toggle('hidden-by-page', !(index >= start && index < end));
        });

        const totalPages = Math.max(1, Math.ceil(visibleCards.length / pageSize));
        if (page > totalPages) {
            column.dataset.page = String(totalPages);
            return paginateColumn(column);
        }

        if (indicator) {
            indicator.textContent = `Page ${column.dataset.page || 1} / ${totalPages}`;
        }
    };

    const applyFilters = () => {
        const search = (searchInput?.value || '').trim().toLowerCase();
        const priority = filterPriority?.value || '';
        const status = filterStatus?.value || '';

        cards.forEach((card) => {
            const matchesSearch =
                !search ||
                card.dataset.title?.includes(search) ||
                card.dataset.description?.includes(search);
            const matchesPriority = !priority || card.dataset.priority === priority;
            const matchesStatus = !status || card.dataset.status === status;

            card.classList.toggle('hidden', !(matchesSearch && matchesPriority && matchesStatus));
        });

        document.querySelectorAll('[data-column]').forEach((column) => {
            paginateColumn(column);
            refreshColumnState(column.querySelector('[data-dropzone]'));
        });
    };

    const sortByDeadline = () => {
        zones.forEach((zone) => {
            const cardsInZone = Array.from(zone.querySelectorAll('[data-task-id]'));
            cardsInZone.sort((a, b) => {
                const aDate = a.dataset.deadline || '';
                const bDate = b.dataset.deadline || '';
                if (!aDate && !bDate) return 0;
                if (!aDate) return 1;
                if (!bDate) return -1;
                return sortAsc ? aDate.localeCompare(bDate) : bDate.localeCompare(aDate);
            });
            cardsInZone.forEach((card) => zone.appendChild(card));
        });
    };

    zones.forEach((zone) => refreshColumnState(zone));
    document.querySelectorAll('[data-column]').forEach((column) => {
        column.dataset.page = '1';
        paginateColumn(column);
    });

    cards.forEach((card) => {
        card.addEventListener('dragstart', (event) => {
            event.dataTransfer.setData('text/plain', card.dataset.taskId);
            event.dataTransfer.effectAllowed = 'move';
        });
    });

    document.querySelectorAll('[data-status-select]').forEach((select) => {
        select.addEventListener('change', async (event) => {
            const taskId = event.target.dataset.taskId;
            const status = event.target.value;
            const card = document.querySelector(`[data-task-id="${taskId}"]`);
            const zone = document.querySelector(`[data-dropzone][data-status="${status}"]`);

            if (card && zone) {
                zone.prepend(card);
                card.dataset.status = status;
                applyFilters();
            }

            await fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ status }),
            });
        });
    });

    document.querySelectorAll('[data-delete]').forEach((button) => {
        button.addEventListener('click', (event) => {
            if (!confirm('Supprimer cette tache ?')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('[data-page-prev]').forEach((button) => {
        button.addEventListener('click', () => {
            const column = button.closest('[data-column]');
            const current = Number(column.dataset.page || '1');
            column.dataset.page = String(Math.max(1, current - 1));
            paginateColumn(column);
        });
    });

    document.querySelectorAll('[data-page-next]').forEach((button) => {
        button.addEventListener('click', () => {
            const column = button.closest('[data-column]');
            const current = Number(column.dataset.page || '1');
            column.dataset.page = String(current + 1);
            paginateColumn(column);
        });
    });

    [searchInput, filterPriority, filterStatus].forEach((input) => {
        input?.addEventListener('input', applyFilters);
        input?.addEventListener('change', applyFilters);
    });

    sortButton?.addEventListener('click', (event) => {
        event.preventDefault();
        sortAsc = !sortAsc;
        sortByDeadline();
        applyFilters();
        sortButton.textContent = `Trier par deadline (${sortAsc ? 'Croissant' : 'Decroissant'})`;
    });

    applyFilters();

    zones.forEach((zone) => {
        zone.addEventListener('dragover', (event) => {
            event.preventDefault();
            zone.classList.add('ring-2', 'ring-indigo-200');
        });

        zone.addEventListener('dragleave', () => {
            zone.classList.remove('ring-2', 'ring-indigo-200');
        });

        zone.addEventListener('drop', async (event) => {
            event.preventDefault();
            zone.classList.remove('ring-2', 'ring-indigo-200');

            const taskId = event.dataTransfer.getData('text/plain');
            const status = zone.dataset.status;
            const card = document.querySelector(`[data-task-id="${taskId}"]`);

            if (!taskId || !status || !card) {
                return;
            }

            zone.prepend(card);
            card.dataset.status = status;
            const select = card.querySelector('[data-status-select]');
            if (select) {
                select.value = status;
            }

            zones.forEach((z) => refreshColumnState(z));
            applyFilters();

            await fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ status }),
            });
        });
    });
</script>
