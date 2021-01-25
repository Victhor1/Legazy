@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
               Bienvenido {{ auth()->user()->name }} al Panel de administración
            </h2>
            <form method="POST" action="{{ route('logout') }}">
                {{csrf_field()}}
                <button>Cerrar sesion</button>
            </form>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 mt-4">
                @if (auth()->user()->role == 0)
                    <div class="mt-2 mb-2">
                        <a href="{{ route('serieL.create') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Legazy
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('serie.create') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Animeflv
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('seriejk.create') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    JKAnime
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('monoschinos.create') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    MonosChinos
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('genre.index') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Agregar Genero
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('user.index') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Usuarios
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-2 mb-2">
                        <a href="{{ route('capitulo.index') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Capítulos
                                </p>
                            </div>
                        </a>
                    </div>
                @elseif(auth()->user()->role == 1)
                    <div class="mt-2 mb-2">
                        <a href="{{ route('genre.index') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Agregar Genero
                                </p>
                            </div>
                        </a>
                    </div>
                @endif
                <div class="mt-2 mb-2">
                    <a href="{{ route('report.index') }}">
                        <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                            <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                {{$reports}} 
                                @if ($reports > 1) 
                                    Reportes
                                @else
                                    Reporte
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-2 mb-2">
                    <a href="{{ route('publicidad.index') }}">
                        <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                            <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                Publicidad
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-2 mb-2">
                    <a href="{{ action('ResetController@reset') }}">
                        <div class="w-full bg-orange-700 block hover:orange-800 rounded-lg">
                            <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                Reset
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-3">

                    <div class="mt-2 mb-2">
                        <div class="w-full bg-blue-700 block hover:bg-blue-800 rounded-lg">
                            <p class="p-12 text-center lg:text-sm md:text-xs">
                                {{$count}} animes
                            </p>
                        </div>
                    </div>

                    <div class="mt-2 mb-2">
                        <div class="w-full bg-blue-700 block hover:bg-blue-800 rounded-lg">
                            <p class="p-12 text-center lg:text-sm md:text-xs">
                                {{$sum}} reproducciones
                            </p>
                        </div>
                    </div>

                    <div class="mt-2 mb-2">
                        <div class="w-full bg-blue-700 block hover:bg-blue-800 rounded-lg">
                            <p class="p-12 text-center lg:text-sm md:text-xs">
                                {{$cero}} series sin reproduccion
                            </p>
                        </div>
                    </div>

                    <div class="mt-2 mb-2">
                        <div class="w-full bg-blue-700 block hover:bg-blue-800 rounded-lg">
                            <p class="p-12 text-center lg:text-sm md:text-xs">
                                {{$capitulo}} capítulos
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection