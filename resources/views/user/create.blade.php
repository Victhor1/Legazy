@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar Usuario
            </h2>

            <div class="pt-10">
                {!!Form::open(['route'=>'user.store','method'=>'POST','files'=>true, 'class'=>'w-full'])!!}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
                                Tipo
                            </label>
                            {!! Form::select('role', [ '0'=>'Super admin','1'=>'Admin','2'=>'Uploader','3'=>'Regular user'], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Nombre del usuario
                            </label>
                            {!!Form::text('name',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa nombre del usuario'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Correo del usuario
                            </label>
                            {!!Form::text('email',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa correo del usuario'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Contraseña del usuario
                            </label>
                            {!!Form::password('password',['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'**********'])!!}
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