<div>
    <input type="text" wire:model.debounce.500ms="search">

    {{ $movies->links() }}

    <input type="checkbox" wire:model="toFilters" value="1">
    <input type="checkbox" wire:model="toFilters" value="2">
    <input type="checkbox" wire:model="toFilters" value="3">

    @dump($toFilters)

    <table class="w-full">
        <thead>
            <th class="cursor-pointer" wire:click="sortBy('id')">
                ID
                @if ($orderBy === 'id')
                    {{ $order === 'ASC' ? '⬆️' : '⬇️' }}
                @endif
            </th>
            <th>Image</th>
            <th class="cursor-pointer" wire:click="sortBy('title')">
                Titre
                @if ($orderBy === 'title')
                    {{ $order === 'ASC' ? '⬆️' : '⬇️' }}
                @endif
            </th>
            <th class="cursor-pointer" wire:click="sortBy('released_at')">
                Date de sortie
                @if ($orderBy === 'released_at')
                    {{ $order === 'ASC' ? '⬆️' : '⬇️' }}
                @endif
            </th>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>
                        <img class="w-24 mx-auto" src="{{ $movie->cover }}" alt="{{ $movie->title }}">
                    </td>
                    <td wire:dblclick="setEditing({{ $movie->id }}, '{{ $movie->title }}')">
                        @if ($editing === $movie->id)
                        <form wire:submit.prevent="update">
                            <input type="text" wire:model.defer="editingTitle">
                            <button class="inline-flex items-center bg-blue-500 px-4 py-2 text-white disabled:opacity-50">
                                <span wire:loading.remove>Modifier</span>
                                <span wire:loading>Modification</span>
                                <span class="ml-8" wire:loading wire:target="update">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </form>
                        @error('editingTitle')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        @else
                        {{ $movie->title }}
                        @endif
                    </td>
                    <td>{{ $movie->released_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
