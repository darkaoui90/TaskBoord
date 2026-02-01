<x-app-layout>
    <div class="bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Modifier la tache</h1>
                <p class="mt-2 text-sm text-slate-500">Mettez a jour les informations de la tache</p>
            </div>

            <form class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm" method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="text-sm font-semibold text-slate-800">Titre *</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700" placeholder="Titre de la tache">
                        @error('title')
                            <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-800">Description</label>
                        <textarea rows="5" name="description" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700" placeholder="Description de la tache (optionnel)">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-800">Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline', optional($task->deadline)->format('Y-m-d')) }}" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700">
                        @error('deadline')
                            <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-800">Priorite</label>
                        <select name="priority" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700">
                            <option value="low" @selected(old('priority', $task->priority) === 'low')>Basse</option>
                            <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Moyenne</option>
                            <option value="high" @selected(old('priority', $task->priority) === 'high')>Haute</option>
                        </select>
                        @error('priority')
                            <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-800">Statut</label>
                        <select name="status" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-700">
                            <option value="todo" @selected(old('status', $task->status) === 'todo')>A faire</option>
                            <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>En cours</option>
                            <option value="done" @selected(old('status', $task->status) === 'done')>Terminee</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('Tasks') }}" class="flex-1 rounded-lg border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Annuler
                    </a>
                    <button type="submit" class="flex-1 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-2">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
