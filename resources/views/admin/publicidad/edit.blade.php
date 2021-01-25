@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar Publicidad
            </h2>

            <div class="pt-10">
                {!!Form::model($publicidad,['route'=>['publicidad.update',$publicidad],'method'=>'PUT','files'=>true, 'class'=>'w-full'])!!}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Tipo
                            </label>
                            {!! Form::select('state', [ '0'=>'Activo','1'=>'Inactivo'], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Nombre de la publicidad
                            </label>
                            {!!Form::text('name',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa nombre de la publicidad'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Codigo de la publicidad
                            </label>
                            {!!Form::textarea('code',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el codigo de la publicidad'])!!}
                        </div>
                    </div>

                    <div class="container mx-auto pt-5">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>

                {!!Form::close()!!}
            </div>

        </div>
    </div>

@endsection