@extends('layouts.main')

@section('tags')
    
    <title>{{$capitulo->serie['name']}} capítulo {{$capitulo['number']}} Sub Español - LEGAZY</title>
    <meta name="description" content="Ver {{ $capitulo->serie['name'] }} Sub Español, descargar {{ $capitulo->serie['name'] }} gratis, {{ $capitulo->serie['name'] }} en calidad HD.">
    <link rel="canonical" href="https://legazy.net/view/{{$capitulo['slug']}}" />
    <meta property="og:url" content="https://legazy.net/view/{{$capitulo['slug']}}" />
    <meta property="og:title" content="{{ $capitulo->serie['name'] }} capítulo {{$capitulo['number']}} Sub Español - LEGAZY" />
    <meta property="og:site_name" content="Legazy" />
    <meta name="description" content="Ver {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español | Descargar {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español">
    <meta property="og:description" content="Ver {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español | Descargar {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español" />
@if ($capitulo->method == 2)
    <meta property="og:image" content="{{asset('images/banners/'.$capitulo->serie->banner)}}" />
@else
    <meta property="og:image" content="{{asset('images/caps/'.$capitulo->picture)}}" />
@endif
    <meta property="og:locale" content="es_ES">

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Ver {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español | Descargar {{ $capitulo['name'] }} capítulo {{$capitulo['number']}} Sub Español" />
    <meta name="twitter:title" content="{{$capitulo->serie['name']}} capítulo {{$capitulo['number']}} Sub Español" />
    <meta name="twitter:domain" content="legazy.net" />
    <meta name="keywords" content="Ver {{ $capitulo->serie['name'] }} Sub Español, descargar {{ $capitulo->serie['name'] }} gratis, {{ $capitulo->serie['name'] }} en calidad HD.">

    <meta name="robots" content="index, follow">

@endsection

@section('css')
    <style>

    @media (min-width: 640px) {
        table {
        display: inline-table !important;
        }

        thead tr:not(:first-child) {
        display: none;
        }
    }

    td:not(:last-child) {
        border-bottom: 0;
    }

    th:not(:last-child) {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
    }
    </style>
@endsection

@section('content')
    
    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">

            <h2 class="uppercase tracking-wider text-white text-lg font-bold mb-8">
                {{$capitulo->serie['name']}} capítulo {{$capitulo['number']}} Sub Español
            </h2>
            @auth
                @if(auth()->user()->role != 3)
                    <div class="mt-2 w-full">
                        <h4 class="text-white font-semibold">Acciones</h4>
                        <div class="flex mt-4 mb-4">
                            <div class="mr-2">
                                <a href="{{ route('capitulo.edit', [$capitulo['slug']]) }}">
                                    <button class="flex items-center bg-orange-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-orange-600 transition ease-in-out duration-150">
                                        <span>
                                            Editar Capítulo 
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="mr-2">
                                {!!Form::open(['route'=>['capitulo.destroy',$capitulo->slug],'method'=>'DELETE'])!!}
                                    <button class="flex items-center bg-red-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-red-600 transition ease-in-out duration-150">
                                        <span>
                                            Eliminar Capítulo 
                                        </span>
                                    </button>
                                {!!Form::close()!!}
                            </div>
                            <div class="mr-2">
                                <a href="{{ action('AddCapituloVideoController@create', [$capitulo['slug']]) }}">
                                    <button class="flex items-center bg-blue-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-blue-600 transition ease-in-out duration-150">
                                        <span>
                                            Agregar video
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="mr-2">
                                <a href="{{ action('AddCapituloDownloadController@create', [$capitulo['slug']]) }}">
                                    <button class="flex items-center bg-green-500 text-gray-900 text-xs rounded font-semibold px-3 py-2 hover:bg-green-600 transition ease-in-out duration-150">
                                        <span>
                                            Agregar descarga
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        </ul>
                    </div>
                @endif
            @endauth
            <div class="flex flex-wrap" id="tabs-id">
                <div class="w-full">
                    @if (count($capitulo->videos) != 0)
                        <ul class="flex mb-0 list-none flex-wrap pt-3 flex-row">
                            @foreach ($capitulo->videos as $video)
                                <li class="flex-auto text-center pb-1">
                                    <a class="text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-white bg-pink-600 hover:bg-pink-400 hover:text-black cursor-pointer border border-pink-700" onclick="changeAtiveTab(event,'tab-{{$video['name']}}')">
                                        {{$video['name']}}
                                    </a>
                                    @auth
                                        @if(auth()->user()->role != 3)
                                            <div>
                                                <a href="{{ route('video.edit', [$video['id']]) }}" class="text-xs font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black">
                                                    editar
                                                </a>
                                                {!!Form::open(['route'=>['video.destroy',$video->id],'method'=>'DELETE'])!!}
                                                    <button class="text-xs font-bold bg-red-600 uppercase px-2 py-1 shadow-lg block w-full leading-normal cursor-pointer hover:bg-red-400 hover:text-black">
                                                        eliminar
                                                    </button>
                                                {!!Form::close()!!}
                                            </div>
                                        @endif
                                    @endauth
                                </li>
                            @endforeach
                        </ul>
                        <div class="container">
                            <div class="grid grid-cols">
                                <div class="mb-2">
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
                        <div class="relative flex flex-col min-w-0 mb-6 shadow-lg rounded h-64 pt-2">
                            <div class="flex-auto">
                                <div class="tab-content tab-space">
                                    @foreach ($capitulo->videos as $video)
                                        <div class=" @if($loop->first)block @else hidden @endif " id="tab-{{$video['name']}}">
                                            @if (explode('/',$video['code'])[2] == 'reproductor.monoschinos.com')
                                                <!--iframe loading="lazy" class="bg-gray-500 w-full rounded h-64" allowfullscreen src="https://monoschinos.com/reproductor?url={{$video['code']}}"frameborder="5" autoplay="false"></iframe-->
                                                <p class="text-gray-500 mt-20 mb-20 text-center">Uppps!! al parecer aún no hay video, intenta con otro reproductor!.<br>Si crees que esto es un error porfavor reporta el capitulo, el equipo legazy se pondra manos a la obra ;)</p>
                                            @else
                                                <iframe loading="lazy" class="bg-gray-500 w-full rounded h-64" allowfullscreen src="{{$video['code']}}"frameborder="5" autoplay="false"></iframe>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 mt-20 mb-20">Uppps!! al parecer aún no hay videos para {{$capitulo['name']}} capítulo {{$capitulo['number']}} Sub Español.<br>Si crees que esto es un error porfavor reporta el capitulo, el equipo legazy se pondra manos a la obra ;)</p>
                    @endif
                    <div class="container">
                        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                            @if($preview != null)
                                <li class="flex-auto text-center pb-1">
                                    <a href="{{ action('FrontController@view', [$preview['slug']]) }}" class="text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-white bg-pink-600 border border-pink-700 cursor-pointer">
                                        Capitulo anterior
                                    </a>
                                </li>
                            @endif
                            <li class="flex-auto text-center pb-1">
                                <a href="{{ action('FrontController@show', [$anime['slug']]) }}" class="text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-white bg-pink-800 hover:bg-pink-500 border border-pink-700 cursor-pointer">
                                    Lista de capitulos
                                </a>
                            </li>
                            @if($next != null)
                                <li class="flex-auto text-center pb-1">
                                    <a href="{{ action('FrontController@view', [$next['slug']]) }}" class="text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-white bg-pink-600 cursor-pointer border border-pink-700">
                                    Capitulo siguiente
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!--div class="container overflow-hidden mb-4">
                        add container
                    </div-->
                    <div class="container">
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                <div x-data="{ isOpen: false }" @keydown.escape="showModal = false">
                                    <ul class="flex mb-0 list-none flex-wrap flex-row">
                                        <li class="flex-auto text-center pb-1">
                                            <button @click="isOpen = true" class="flex inline-flex items-center w-full text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-gray-900 bg-green-600 cursor-pointer rounded">
                                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/></svg>
                                                    <span class="ml-2">Descargar Capítulo</span>
                                            </button>
                                        </li>
                                    </ul>
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
                                                            @if (count($capitulo->downloads) != 0)
                                                            <p>Descargas</p>
                                                            <table class="w-full border mt-4 mb-4 overflow-hidden">
                                                                <tr class="bg-teal-400 border">
                                                                    <th class="border">Servidor</th>
                                                                    @auth
                                                                        <th class="border">
                                                                            Acciones
                                                                        </th>
                                                                    @endauth
                                                                </tr>
                                                                @foreach ($capitulo->downloads as $download)
                                                                    <tr class="border">
                                                                        <td class="border text-center hover:bg-teal-600 p-3 truncate">
                                                                            <a class="pt-4" href="{{$download['code']}}" target="_blank">
                                                                                {{explode('/',$download['code'])[2]}}
                                                                            </a>
                                                                        </td>
                                                                        @auth
                                                                            <td class="border text-center p-3 truncate">
                                                                                <a href="{{ route('download.edit', [$download['id']]) }}" class="text-xs font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black text-center mb-2">
                                                                                    editar
                                                                                </a>
                                                                                {!!Form::open(['route'=>['download.destroy',$download->id],'method'=>'DELETE'])!!}
                                                                                    <button class="text-xs font-bold bg-red-600 uppercase px-2 py-1 shadow-lg block w-full leading-normal cursor-pointer hover:bg-red-400 hover:text-black">
                                                                                        eliminar
                                                                                    </button>
                                                                                {!!Form::close()!!}
                                                                            </td>
                                                                        @endauth
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                            @else
                                                            <p>UPSSS!! Al parecer no hay descargas disponibles para {{$capitulo['name']}} capítulo {{$capitulo['number']}} Sub Español.<br>Si crees que esto es un error reporta el capitulo, el equipo legazy se pondra manos a la obra ;)</p>   
                                                            @endif
                                                        </div>
                                                        <div class="flex justify-end pt-2">
                                                            <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" @click="isOpen = false">cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                <div x-data="{ report: false }" @keydown.escape="showModal = false">
                                    <ul class="flex mb-0 list-none flex-wrap flex-row">
                                        <li class="flex-auto text-center pb-1">
                                            <button @click="report = true" class="flex inline-flex items-center w-full text-xs font-bold uppercase px-2 py-1 shadow-lg block leading-normal text-gray-900 @if (!isset($capitulo->report)) bg-orange-600 @else bg-red-700 @endif cursor-pointer rounded">
                                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                                    <span class="ml-2">
                                                        @if (!isset($capitulo->report))
                                                            Reportar Capítulo
                                                        @else 
                                                            <p>Este capítulo ya fue reportado!!!</p>
                                                        @endif
                                                    </span>
                                            </button>
                                        </li>
                                    </ul>
                                    <template x-if="report">
                                        <div style="background-color: rgba(0, 0, 0, .5);" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50">
                                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                                <div class="bg-gray-900 rounded">
                                                    <div class="flex justify-end pr-4 pt-2">
                                                        <button @click="report = false" @keydown.escape.window="report = false" class="absolute text-3xl leading-none hover:text-gray-300">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <div class="modal-body px-8 py-8">
                                                        <div class="responsive-container overflow-hidden">
                                                            @if (!isset($capitulo->report))
                                                            <p>Ayudanos a mejorar, si los servidores de reproducción o descarga estan caidos, porfavor reporta el capítulo, el equipo legazy se pondra manos a la obra</p>
                                                            <div class="pt-4">
                                                                {!!Form::model($capitulo,['route'=>['report.store',$capitulo],'method'=>'POST','files'=>true, 'class'=>'w-full'])!!}
                                                                <div class="flex flex-wrap -mx-3 mt-6 mb-4">
                                                                    <div class="w-full px-3">
                                                                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                                                            Describe el problema
                                                                        </label>
                                                                        {!!Form::textarea('description',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ayudanos a saber que es lo que pasa, deja un brebe comenatrio describiendo el problema (no es obligatorio)'])!!}
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-wrap -mx-3 mt-6 mb-4 hidden">
                                                                    <div class="w-full px-3">
                                                                        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                                                            ID
                                                                        </label>
                                                                        {!!Form::text('id',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ayudanos a saber que es lo que pasa, deja un brebe comenatrio describiendo el problema (no es obligatorio)'])!!}
                                                                    </div>
                                                                </div>
                                                                <div class="container mx-auto pt-3 mb-4">
                                                                    <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                                        Reportar
                                                                    </button>
                                                                </div>
                                                                {!!Form::close()!!}
                                                            </div>
                                                            @else
                                                            <p>Este capitulo ya a sido reportado {{ \Carbon\Carbon::parse($capitulo->report['created_at'])->diffForHumans() }}, estamos trabajando para solucionarlo</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
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
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        function changeAtiveTab(event,tabID){
            let element = event.target;
            while(element.nodeName !== "A"){
            element = element.parentNode;
            }
            ulElement = element.parentNode.parentNode;
            aElements = ulElement.querySelectorAll("li > a");
            tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
            for(let i = 0 ; i < aElements.length; i++){
            aElements[i].classList.remove("text-white");
            aElements[i].classList.remove("bg-pink-600");
            aElements[i].classList.add("text-pink-600");
            aElements[i].classList.add("bg-white");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
            }
            element.classList.remove("text-pink-600");
            element.classList.remove("bg-white");
            element.classList.add("text-white");
            element.classList.add("bg-pink-600");
            document.getElementById(tabID).classList.remove("hidden");
            document.getElementById(tabID).classList.add("block");
        }
    </script>
@endsection