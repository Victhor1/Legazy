@extends('layouts.main')

@section('css')
    @include('serie.form.css')
@endsection

@section('js')
    @include('serie.form.js')
@endsection

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">

            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar relacion a {{$anime['name']}}
            </h2>

            <div class="pt-6">
                {!!Form::model($anime,['route'=>['relacion.store'],'method'=>'POST','files'=>true, 'class'=>'w-full'])!!}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Tipo
                            </label>
                            {!! Form::select('type', [ '0'=>'Precuela','1'=>'Secuela','2'=>'Historia paralela','3'=>'Película'], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Serie relacionada
                            </label>
                            {!! Form::select('relacion', $relacion, null, ['class'=>'select-genero select-relacion appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full px-3">
                            {!!Form::number('id',null,['class'=>'hidden appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la número del capitulo'])!!}
                        </div>
                    </div>

                    <div class="container mx-auto pt-5 mb-6">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Registrar
                        </button>
                    </div>

                {!!Form::close()!!}
            </div>

        </div>
    </div>

@endsection