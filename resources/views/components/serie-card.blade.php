<div class="mt-8">  
    <a href="{{ action('FrontController@show', [$serie['slug']]) }}">
        @if($serie->type == 0)
            <span class="absolute bg-blue-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Anime</span>
        @elseif($serie->type == 1)
            <span class="absolute bg-red-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Película</span>
        @elseif($serie->type == 2)
            <span class="absolute bg-purple-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Especial</span>
        @elseif($serie->type == 3)
            <span class="absolute bg-green-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Ova</span>
        @elseif($serie->type == 4)
            <span class="absolute bg-indigo-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Ona</span>
        @elseif($serie->type == 5)
            <span class="absolute bg-yellow-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Corto</span>
        @elseif($serie->type == 6)
            <span class="absolute bg-gray-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Donghua</span>
        @endif
        @auth
            <span class="flex absolute bg-green-500 rounded-full text-white-900 text-xs font-semibold mx-1 mt-6 my-1 px-2 hover:opacity-0">
                <svg class="fill-current" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" ></path></svg>
                <p class="pl-2">{{$serie['counterView']}}</p>
            </span>
        @endauth
        <img loading="lazy" src="{{ '/images/covers/'.$serie['cover'] }}" alt="{{ $serie['name'] }}" class="w-full rounded-lg shadow-lg hover:opacity-75 hover:shadow-2xl transition ease-in-out duration-150 h-56">
    </a>
    <div class="mt-2 text-center">
        <a href="{{ action('FrontController@show', [$serie['slug']]) }}" class="text-sm mt-2 hover:text-gray:300">{{ $serie['name'] }}</a>
    </div>
</div>