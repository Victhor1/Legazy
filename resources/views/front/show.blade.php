@extends('layouts.main')

@section('tags')
    
    <title>{{ $anime['name'] }} - LEGAZY</title>
    <meta name="description" content="{{ $anime['description'] }}">
    <link rel="canonical" href="https://legazy.net/anime/{{ $anime['slug'] }}" />
    <meta property="og:url" content="https://legazy.net/anime/{{ $anime['slug'] }}" />
    <meta property="og:title" content="{{ $anime['name'] }} - LEGAZY" />
    <meta property="og:site_name" content="Legazy" />
    <meta name="description" content="{{ $anime['description'] }}">
    <meta property="og:description" content="{{ $anime['description'] }}" />
    <meta property="og:image" content="{{asset('images/banners/'.$anime->banner)}}" />
    <meta property="og:locale" content="es_ES">

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{ $anime['description'] }}" />
    <meta name="twitter:title" content="{{ $anime['name'] }}" />
    <meta name="twitter:domain" content="legazy.net" />
    <meta name="keywords" content="{{ $anime['name'] }},{{ $anime['name'] }} sub español">

    <meta name="robots" content="index, follow">

@endsection

@section('content')

    <div class="serie-info borde-b border-gray-700">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ '/images/covers/'.$anime['cover'] }}" alt="{{ $anime['name'] }}" class=" rounded-lg w-full md:w-64 sm:w-64 mb-6">
                @if ($anime->video != 'void')
                    <div x-data="{ isOpen: false }" @keydown.escape="showModal = false">
                        <button @click="isOpen = true" class="text-center bg-purple-600 hover:bg-purple-700 w-full block mb-4 rounded py-2 text-white">
                            <span class="flex items-center justify-center">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Preview del anime</p>
                            </span>
                        </button>
                        <template x-if="isOpen">
                            <div style="background-color: rgba(0, 0, 0, .5);" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50">
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false" class="absolute text-3xl leading-none hover:text-gray-300">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden">
                                                <iframe width="560" height="415" src="{{str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$anime['video'])}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" class="w-full" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                @endif
            </div>
            <div class="md:ml-24">
                <h1 class="font-serif sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold text-center my-2">
                    {{ $anime['name'] }} @if ($anime->languaje != 1) Sub Español @endif
                </h1>
                <div class="flex flex-wrap items-center text-gray-400 text-sm justify-center">
                    @if($anime->type == 0)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Anime</p>
                            </span>
                        </a>
                    @elseif($anime->type == 1)
                    <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                            <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Película</p>
                            </span>
                        </a>
                    @elseif($anime->type == 2)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Especial</p>
                            </span>
                        </a>
                    @elseif($anime->type == 3)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Ova</p>
                            </span>
                        </a>
                    @elseif($anime->type == 4)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Ona</p>
                            </span>
                        </a>
                    @elseif($anime->type == 5)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Corto</p>
                            </span>
                        </a>
                    @elseif($anime->type == 6)
                        <a href="{{ action('FrontController@type', [$anime['type']]) }}">
                            <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-indigo-500">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16 8.38l4.55-2.27A1 1 0 0 1 22 7v10a1 1 0 0 1-1.45.9L16 15.61V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z"/></svg>
                                <p class="mx-1">Donghua</p>
                            </span>
                        </a>
                    @endif
                    <span class="mx-2 mb-2"></span>
                    @if($anime->status == 0)
                        <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-red-500">
                            <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M13 17h-2v2h2v-2zm2 0v2h2a1 1 0 0 1 0 2H7a1 1 0 0 1 0-2h2v-2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-5zM4 5v10h16V5H4z"/></svg>
                            <p class="mx-1">Finalizado</p>
                        </span>
                    @elseif($anime->status == 1)
                        <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-green-500">
                            <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M13 17h-2v2h2v-2zm2 0v2h2a1 1 0 0 1 0 2H7a1 1 0 0 1 0-2h2v-2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-5zM4 5v10h16V5H4z"/></svg>
                            <p class="mx-1">En emisión</p>
                        </span>
                    @endif
                    <span class="mx-2 mb-2"></span>

                    <span class="flex items-center mb-2 rounded-full bg-transparent px-2 py-1 text-xs font-semibold border border-white-500">
                            <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"/></svg>
                        <p class="mx-1">{{ \Carbon\Carbon::parse($anime['published'])->format('M d, Y') }}</p>
                    </span>
                    <span class="mx-2 mb-2">|</span>

                    @foreach ($anime->genres as $genre)
                        <a href="{{ action('FrontController@genreshow', [$genre['slug']]) }}">
                            <button class="flex items-center ml-1 bg-transparent hover:bg-{{ $genre['color'] }}-500 font-semibold hover:text-white py-1 px-2 mb-2 border border-white-500 hover:border-transparent rounded-full text-xs mr-1 focus:outline-none focus:shadow-outline">
                                <svg class="w-3 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/></svg>
                                <span class="mx-1">{{ $genre['name'] }}</span>
                            </button>
                        </a>
                    @endforeach

                </div>
                <div class="text-gray-300 mt-6 text-justify overflow-y-auto @if(strlen($anime['description']) >= 398) lg:h-24 h-auto @endif">
                    <p class="px-4">
                        {!! $anime['description'] !!}
                    </p>
                </div>
                @if (count($anime->relaciones) != 0)
                    <h4 class="font-semibold mt-10">Animes relacionados :</h4>
                    <div class="grid @if (count($anime->relaciones) < 2) grid-cols-1 @else grid-cols-2 @endif sm:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach ($anime->relaciones as $relacion)
                        <div class="mt-4">
                            <span class="absolute bg-green-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 uppercase">
                                @if ($relacion['type'] == 0)
                                    precuela
                                @elseif($relacion['type'] == 1)
                                    secuela
                                @elseif($relacion['type'] == 2)
                                    Historia Paralela
                                @elseif($relacion['type'] == 3)
                                    Película
                                @endif
                            </span>
                            <span class="mt-6 absolute bg-blue-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2">
                                @if ($relacion->Stype == 0)
                                    Anime
                                @elseif($relacion->Stype == 1)
                                    Película
                                @elseif($relacion->Stype == 2)
                                    Especial
                                @elseif($relacion->Stype == 3)
                                    Ova
                                @endif
                            </span>
                            <a href="{{ action('FrontController@show', [$relacion['slug']]) }}">
                                <img src="{{ '/images/covers/'.$relacion['picture'] }}" alt="{{ $relacion['name'] }}" class="rounded-lg hover:opacity-75 transition ease-in-out duration-150 w-full">
                            </a>
                            <a href="{{ action('FrontController@show', [$relacion['slug']]) }}" class="text-xs text-center leading-normal block text-gray-400 hover:text-white mt-1">
                                {{$relacion['name']}}
                            </a>
                            @auth
                                @if(auth()->user()->role == 0)
                                    <div class="mt-2">
                                        <a href="{{ route('relacion.edit', [$relacion['id']]) }}" class="text-xs text-center font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black">
                                            editar
                                        </a>
                                        {!!Form::open(['route'=>['relacion.destroy',$relacion->id],'method'=>'DELETE'])!!}
                                            <button class="text-xs font-bold bg-red-600 uppercase px-2 py-1 shadow-lg block w-full leading-normal cursor-pointer hover:bg-red-400 hover:text-black">
                                                eliminar
                                            </button>
                                        {!!Form::close()!!}
                                    </div>
                                @endif
                            @endauth
                        </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="font-semibold mt-10 text-center text-teal-600">Este anime solo tiene una temporada</h4>
                @endif
                @auth
                    @if(auth()->user()->role == 0)
                    <div class="mt-10">
                        <h4 class="text-white font-semibold">Acciones</h4>
                        <div class="flex mt-4">
                            <div class="mr-2">
                                <a href="{{ route('serie.edit', [$anime['slug']]) }}">
                                    <button class="flex items-center bg-orange-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-orange-600 transition ease-in-out duration-150">
                                    <span>Editar 
                                        @if ($anime->type == 0)
                                        Anime
                                        @elseif($anime->type == 1)
                                        Película
                                        @elseif($anime->type == 2)
                                        Especial
                                        @elseif($anime->type == 3)
                                        Ova
                                        @endif
                                    </span>
                                </button>
                                </a>
                            </div>
                            @if ($anime['status'] != 0)
                                <div class="mr-2">
                                    <a href="{{ action('AddSerieCapituloController@create', [$anime['slug']]) }}">
                                        <button class="flex items-center bg-blue-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-blue-600 transition ease-in-out duration-150">
                                        <span>Agregar Capitulo
                                        </span>
                                    </button>
                                    </a>
                                </div>
                            @endif
                            <div class="mr-2">
                                {!!Form::open(['route'=>['serie.destroy',$anime->slug],'method'=>'DELETE'])!!}
                                        <button class="flex items-center bg-red-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-red-600 transition ease-in-out duration-150">
                                            <span>Eliminar
                                                @if ($anime->type == 0)
                                                Anime
                                                @elseif($anime->type == 1)
                                                Película
                                                @elseif($anime->type == 2)
                                                Especial
                                                @elseif($anime->type == 3)
                                                Ova
                                                @endif
                                            </span>
                                        </button>
                                {!!Form::close()!!}
                            </div>
                            <div class="mr-2">
                                <a href="{{ action('AddRelacionSerieController@create', [$anime['slug']]) }}">
                                    <button class="flex items-center bg-green-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-green-600 transition ease-in-out duration-150">
                                        <span>
                                            Agregar relación
                                        </span>
                                    </button>
                                </a>
                            </div>
                            @if ($anime['status'] != 0)
                                <div class="mr-2">
                                    <a href="{{ action('AddSerieCapituloController@legazy', [$anime['slug']]) }}">
                                        <button class="flex items-center bg-white text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-gray-600 transition ease-in-out duration-150">
                                        <span>Legazy Capitulo
                                        </span>
                                    </button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @elseif(auth()->user()->role != 3)
                        @if ($anime['status'] != 0)
                            <div class="mt-10">
                                <div class="mr-2">
                                    <a href="{{ action('AddSerieCapituloController@create', [$anime['slug']]) }}">
                                        <button class="flex items-center bg-blue-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-blue-600 transition ease-in-out duration-150">
                                        <span>Agregar Capitulo
                                        </span>
                                    </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="cap-list border-t border-gray-700">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full lg:w-1/2 px-3"> 
                    <h2 class="text-center uppercase text-2xl font-semibold text-orange-500">Lista de capítulos, {{count($anime->capitulos)}} en total</h2>
                    <ul class="border border-blue-900 pt-4 list-none leading-loose pl-5 mt-8 @if(count($anime->capitulos) > 8) h-screen @endif overflow-y-auto">
                        @if (count($anime->capitulos) != 0)
                            @foreach($anime->capitulos as $capitulo)
                                <a href="{{ action('FrontController@view', [$capitulo['slug']]) }}" class="hover:no-underline">
                                    <li class="px-4 mb-6 hover:bg-teal-500">
                                        <strong>
                                            <span class="flex items-center mb-4 justify-center border-b-2 border-blue-900">
                                                <svg class="w-6 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                <p class="ml-2">
                                                    {{$capitulo->serie['name']}} capítulo {{$capitulo['number']}} sub español
                                                </p>
                                            </span>
                                            <!--{{$capitulo['name']}} capítulo {{$capitulo['number']}} | 
                                            <a href="{{ route('capitulo.edit', [$capitulo['slug']]) }}">
                                                <span class="
                                                @if($capitulo->counterView != 0)
                                                    bg-green-600 hover:bg-green-700
                                                @else
                                                    bg-orange-600 hover:bg-orange-700 
                                                @endif
                                                rounded px-2">Editar</span>
                                            </a-->
                                        </strong>
                                    </li>
                                    <div class="mt-2 mb-2">
                                        @auth
                                            <a href="{{ route('capitulo.edit', [$capitulo['slug']]) }}" class="text-xs font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black rounded text-center mb-2">
                                                editar
                                            </a>
                                            {!!Form::open(['route'=>['capitulo.destroy',$capitulo->slug],'method'=>'DELETE'])!!}
                                                <button class="shadow-lg font-bold uppercase text-xs bg-red-800 block w-full rounded px-2 hover:bg-red-600">
                                                    Eliminar
                                                </button>
                                            {!!Form::close()!!}
                                        @endauth
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500">Uppps!! al parecer aún no hay capitulos para {{$anime['name']}}</p>
                        @endif
                    </ul>
                </div>
                <div class="w-full md:w-1/2 px-3 lg:block hidden">
                    <h2 class="text-center uppercase text-2xl font-semibold text-orange-500">Animes recomendados</h2>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($series as $serie)
                            <x-serie-card :serie='$serie' />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-4">
        <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://https-legazy-net.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div> 

@endsection