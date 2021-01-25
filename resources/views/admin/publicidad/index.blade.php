@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-12">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Publicidad en la plataforma
            </h2>

            <div class="grid grid-cols mt-4">
                <div class="mt-2 mb-2">
                    <div class="w-full bg-purple-700 block rounded-lg">
                        <a href="{{ route('publicidad.create') }}">
                            <p class="px-4 py-2 text-center lg:text-sm md:text-xs">
                                Registrar Publicidad
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-4">
                <table class="table-fixed w-full">
                    <thead class="border bg-green-600">
                        <tr>
                            <th class="border w-1/3 px-4 py-2">Nombre</th>
                            <th class="border w-1/3 px-4 py-2">Estado</th>
                            <th class="border w-1/3 px-4 py-2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adds as $add)
                            <tr>
                                <td class="border px-4 py-2 text-center">
                                    {{$add['name']}}
                                </td>
                                <td class="border px-4 py-2 text-center @if($add->state == 0) bg-green-600 @elseif($add->state == 1)
                                        bg-orange-600 @endif">
                                    @if($add->state == 0)
                                        Activo
                                    @elseif($add->state == 1)
                                        Inactivo
                                    @endif
                                </td>
                                <td class="border px-4 py-2">
                                    <div>
                                        <a href="{{ route('publicidad.edit', [$add['slug']]) }}" class="text-xs text-center font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black mt-2 mb-2">
                                            editar
                                        </a>
                                        {!!Form::open(['route'=>['publicidad.destroy',$add->slug],'method'=>'DELETE'])!!}
                                            <button class="mt-2 mb-2 text-xs font-bold bg-red-600 uppercase px-2 py-1 shadow-lg block w-full leading-normal cursor-pointer hover:bg-red-400 hover:text-black">
                                                eliminar
                                            </button>
                                        {!!Form::close()!!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection