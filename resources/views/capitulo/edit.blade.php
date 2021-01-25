@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-10">
        <div class="option-series">

            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Editar capítulo
            </h2>

            <div class="pt-6">
                {!!Form::model($capitulo,['route'=>['capitulo.update',$capitulo],'method'=>'PUT','files'=>true, 'class'=>'w-full'])!!}

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
                                Número delñ capítulo
                            </label>
                            {!!Form::number('number',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
                        </div>
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
                                Status
                            </label>
                            {!!Form::number('status',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
                        </div>
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
                                Anime Status
                            </label>
                            {!!Form::number('AnimeStatus',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
                        </div>
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
                                Metodo
                            </label>
                            {!!Form::number('method',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Nombre
                            </label>
                            {!!Form::text('name',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url der la serie'])!!}
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                slug
                            </label>
                            {!!Form::text('slug',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url der la serie'])!!}
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Url
                            </label>
                            {!!Form::text('url',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa la url der la serie'])!!}
                        </div>
                    </div>

                    <div class="container mx-auto pt-5 mb-6">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>

                {!!Form::close()!!}
            </div>

        </div>
    </div>

@endsection