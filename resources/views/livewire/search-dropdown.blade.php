<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input 
        wire:model.debounce.500ms="search" 
        type="text" 
        class="bg bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" 
        placeholder="Buscar.."
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 tex-gary-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3">

    </div>

    @if (strlen($search) > 2)
        <div 
            class="z-50 absolute bg-gray-800 rounded text-sm w-64 h-64 mt-4 overflow-y-auto" 
            x-show.transition.opacity="isOpen"
        >
            @if (count($searchResults) > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{ action('FrontController@show', [$result['slug']]) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                                <img src="{{ '/images/covers/'.$result['cover'] }}" alt="{{ $result['name'] }}" class="w-16">
                                <span class="ml-4">{{ $result['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">
                    No hay resultados para "{{ $search }}"
                </div>
            @endif
        </div>
    @endif
</div>
