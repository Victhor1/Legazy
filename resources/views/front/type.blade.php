@extends('layouts.main')

@section('tags')
    
    <title>Legazy</title>
    <link rel="canonical" href="https://legazy.net/" />
    <meta property="og:url" content="https://legazy.net/" />
    <meta property="og:title" content="LEGAZY" />
    <meta property="og:site_name" content="Legazy" />
    <meta name="description" content="LEGAZY - La mejor web para ver anime online, subtitulado y/o doblado al español, en HD y completamente gratis. Aquí podrás ver y descargar todas tus series">
    <meta property="og:description" content="LEGAZY - La mejor web para ver anime online, subtitulado y/o doblado al español, en HD y completamente gratis. Aquí podrás ver y descargar todas tus series" />
    <meta property="og:image" content="{{asset('images/legazy/w1.png')}}" />
    <meta property="og:locale" content="es_ES">

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="LEGAZY - La mejor web para ver anime online, subtitulado y/o doblado al español, en HD y completamente gratis. Aquí podrás ver y descargar todas tus series" />
    <meta name="twitter:title" content="Legazy.net" />
    <meta name="twitter:domain" content="legazy.net" />
    <meta name="keywords" content="anime sub español">

    <meta name="robots" content="index, follow">

@endsection

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">
            <div class="flex flex-wrap border-b-4 border-blue-600 mb-2">
                <span class="flex items-center mb-4">
                    <svg class="w-6 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    <h2 class="tracking-wider text-white text-lg font-semibold ml-2">
                        @if ($series2['type'] == 0)
                            Animes
                        @elseif($series2['type'] == 1)
                            Películas
                        @elseif($series2['type'] == 2)
                            Especiales
                        @elseif($series2['type'] == 3)
                            Ovas
                        @endif
                    </h2>
                </span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">

                @foreach ($series as $serie)
                    <x-serie-card :serie='$serie' />
                @endforeach

            </div>
            <div class="flex flex-wrap text-xs justify-center w-full mt-10">
                {{$series->onEachSide(2)->links()}}
            </div>
        </div>
    </div>

@endsection