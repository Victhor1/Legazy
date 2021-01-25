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
                Editar relacion de {{$relacion['name']}}
            </h2>

            <div class="pt-6">
                {!!Form::model($relacion,['route'=>['relacion.update',$relacion],'method'=>'PUT','files'=>true, 'class'=>'w-full'])!!}

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
                                Tipo de serie
                            </label>
                            {!! Form::select('Stype', [ '0'=>'Anime','1'=>'Película','2'=>'Especial paralela','3'=>'Ova'], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Serie a la que esta relacionada
                            </label>
                            {!! Form::select('serie_id', $anime, null, ['class'=>'select-genero select-relacion appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Nombre
                            </label>
                            {!!Form::text('name',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Slug
                            </label>
                            {!!Form::text('slug',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Imagen
                            </label>
                            {!!Form::text('picture',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                fecha de publicacion
                            </label>
                            {!!Form::date('published',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full px-3">
                            {!!Form::number('relacion_id',null,['class'=>'hidden appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la número del capitulo'])!!}
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