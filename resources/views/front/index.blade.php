@extends('layouts.main')

@section('tags')
    
    <title>Legazy - Anime sub español y latino</title>
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

@section('css')
    <link rel="stylesheet" href="{{asset('css/corrusel.css')}}">
@endsection

@section('js')
    <script src="{{asset('js/corrousel.js')}}"></script>
@endsection

@section('content')

    <div class="w-full relative pt-10 mb-4">
        @foreach ($tops as $top)
            <div class="mySlides fade">
                <div class="numbertext">Lo m&aacute;s visto</div>
                <a href="{{ action('FrontController@show', [$top['slug']]) }}">
                    <img src="{{ '/images/banners/'.$top['banner'] }}" class="w-full h-64 lg:h-screen">
                    <div class="text font-bold">
                        {{$top['name']}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div style="text-align:center">
        @foreach ($tops as $top)
            <span class="dot"></span>
        @endforeach
    </div>
    
    <div class="container mx-auto px-4">
        <div class="grid grid-cols mt-4">
            <div class="mt-2 mb-2">
                <div class="w-full bg-blue-700 block rounded-lg ">
                    <a href="https://www.facebook.com/legazy.net" target="_blank">
                        <span class="flex items-center justify-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                width="30" height="30"
                                viewBox="0 0 24 24"
                                style=" fill:#ffffff;"><path d="M 21.800781 0 L 2.199219 0 C 1 0 0 1 0 2.199219 L 0 21.800781 C 0 23 1 24 2.199219 24 L 12 24 L 12 14 L 9 14 L 9 11 L 12 11 L 12 8 C 12 5.5 13 4 16 4 L 19 4 L 19 7 L 17.699219 7 C 16.800781 7 16 7.800781 16 8.699219 L 16 11 L 20 11 L 19.5 14 L 16 14 L 16 24 L 21.800781 24 C 23 24 24 23 24 21.800781 L 24 2.199219 C 24 1 23 0 21.800781 0 Z"></path></svg>
                        <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                            Facebook
                        </p>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pt-10">
        <div class="cartelera mb-12">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full lg:w-1/5 px-3 lg:block hidden">
                    <div class="flex flex-wrap border-b-4 border-blue-600 mb-6">
                        <span class="flex items-center mb-4">
                            <svg class="w-6 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                            <h2 class="tracking-wider text-white text-lg font-semibold ml-2">
                                Lo más visto
                            </h2>
                        </span>
                    </div>
                    <div class="gap-3">
                        <div class="mt-8 bg-teal-600 rounded rounded-lg shadow-lg">
                            <ul class="list-none">
                                @foreach ($recomens as $serie)
                                    <a href="{{ action('FrontController@show', [$serie['slug']]) }}">
                                        <li class="text-xs text-white-900 text-center px-3 py-4 hover:bg-teal-500">
                                            {{$serie['name']}}@auth - {{$serie['counterView']}}@endauth 
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-4/5 px-3">
                    <div class="flex flex-wrap border-b-4 border-blue-600 mb-6">
                        <span class="flex items-center mb-4">
                            <svg class="w-6 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                            <h2 class="tracking-wider text-white text-lg font-semibold ml-2">
                                Capítulos Diarios
                            </h2>
                        </span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-3">
                        @foreach ($capitulos as $capitulo)
                            <div class="mt-1">
                                <a href="{{ action('FrontController@view', [$capitulo['slug']]) }}">
                                    <span class="absolute bg-blue-500 rounded-full text-white-900 text-xs font-semibold mx-1 my-1 px-2 hover:opacity-0">Capítulo {{$capitulo['number']}}</span>
                                    @auth
                                        <span class="flex absolute bg-green-500 rounded-full text-white-900 text-xs font-semibold mx-1 mt-6 my-1 px-2 hover:opacity-0">
                                            <svg class="w-3 fill-current" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                            <p class="pl-2">{{$capitulo['counterView']}}</p>
                                        </span>
                                    @endauth
                                    @if ($capitulo->method == 2)
                                        <img loading="lazy" src="{{ '/images/banners/'.$capitulo->serie->banner }}" alt="{{ $capitulo['picture'] }}" class="w-full h-24 lg:h-32 rounded-lg shadow-lg hover:opacity-75 transition ease-in-out duration-150">
                                    @else
                                        <img loading="lazy" src="{{ '/images/caps/'.$capitulo['picture'] }}" alt="{{ $capitulo['picture'] }}" class="w-full h-24 lg:h-32 rounded-lg shadow-lg hover:opacity-75 transition ease-in-out duration-150">
                                    @endif
                                </a>
                                <div class="mt-2 text-center">
                                    <a href="{{ action('FrontController@view', [$capitulo['slug']]) }}" class="text-sm mt-2 hover:text-gray:300">
                                        {{$capitulo->serie['name']}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:block hidden popular-series">
            <div class="flex flex-wrap border-b-4 border-blue-600 mb-6">
                <span class="flex items-center mb-4">
                    <svg class="w-6 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    <h2 class="tracking-wider text-white text-lg font-semibold ml-2">
                        Ultimos Animes Agregados
                    </h2>
                </span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">

                @foreach ($series as $serie)
                    <x-serie-card :serie='$serie' />
                @endforeach

            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-10">
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