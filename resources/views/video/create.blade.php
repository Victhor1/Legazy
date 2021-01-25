@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">

            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar video a {{$capitulo['name']}} capítulo {{$capitulo['number']}}
            </h2>

            <div class="pt-6">
                {!!Form::model($capitulo,['route'=>['video.store'],'method'=>'POST','files'=>true, 'class'=>'w-full'])!!}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Nombre
                            </label>
                            {!!Form::text('nombre',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa nombre del servidor'])!!}
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Codigo
                            </label>
                            {!!Form::text('code',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url del video'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full px-3">
                            {!!Form::text('slug',null,['class'=>'hidden appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url general de la serie'])!!}
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