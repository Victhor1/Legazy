@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
               Capítulos
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-3 mt-4">
                
                <div class="mt-2 mb-2">
                    <div class="w-full bg-purple-700 block rounded-lg">
                        <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                            Total {{$total}}
                        </p>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <div class="w-full bg-green-700 block rounded-lg">
                        <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                            Vistos {{$totalView}}
                        </p>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <div class="w-full bg-orange-500 block rounded-lg">
                        <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                            No vistos {{$totalNoView}}
                        </p>
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <div class="w-full bg-orange-500 block rounded-lg">
                        <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                            No registrados {{$totalNoStatus}}
                        </p>
                    </div>
                </div>

            </div>
            @if (count($noViews) == 0)
                <div class="mt-4 mb-2 text-center bg-blue-600 rounded py-8">
                    <p>
                        No hay capítulos por registrar
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 mt-2 mb-2">
                    <div class="mt-2 mb-2">
                        <a href="{{ action('AddCapituloController@register') }}">
                            <div class="w-full bg-orange-700 block hover:bg-orange-500 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                    Registrar
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap mt-4 mb-2">
                    <table class="table-fixed w-full">
                        <thead class="border bg-green-600">
                            <tr>
                                <th class="border w-2/3 px-4 py-2">Capitulos No Registrados</th>
                                <th class="border w-1/3 px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($noViews as $noView)
                                <tr>
                                    <td class="border px-4 py-2 text-center">
                                        <a class="hover:bg-orange-600" href="{{ action('FrontController@view', [$noView['slug']]) }}">
                                            {{$noView->serie['name']}} capítulo {{$noView['number']}}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('capitulo.edit', [$noView['slug']]) }}" class="text-xs font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black rounded text-center mb-2">
                                            editar
                                        </a>
                                        {!!Form::open(['route'=>['capitulo.destroy',$noView->slug],'method'=>'DELETE'])!!}
                                            <button class="bg-red-800 block w-full rounded px-2 hover:bg-red-600">
                                                Eliminar
                                            </button>
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    
@endsection