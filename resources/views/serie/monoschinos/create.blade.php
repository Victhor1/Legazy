@extends('layouts.main')

@section('css')
    @include('serie.form.css')
@endsection

@section('js')
    @include('serie.form.js')
@endsection

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar Serie de MonosChinos.com
            </h2>

            <div class="pt-16">
                {!!Form::open(['route'=>'monoschinos.store','method'=>'POST','files'=>true, 'class'=>'w-full'])!!}
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Url de la serie
                            </label>
                            {!!Form::text('url',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url general de la serie'])!!}
                            <!--p class="text-red-500 text-xs italic">Please fill out this field.</p-->
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
                                Seleccionar Generos
                            </label>
                            {!! Form::select('genres[]', $genre, null, ['class'=>'select-genero appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500','multiple']) !!}
                        </div>
                    </div>

                    <div class="container mx-auto pt-5">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Registrar
                        </button>
                    </div>

                {!!Form::close()!!}
            </div>

        </div>
    </div>

@endsection