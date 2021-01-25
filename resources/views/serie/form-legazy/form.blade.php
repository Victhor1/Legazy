<div class="flex flex-wrap -mx-3 mt-6 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
            Nombre de la serie
        </label>
        {!!Form::text('name',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
    </div>
</div>

<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
            Fecha de publicacion
        </label>
        {!!Form::date('published',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
    </div>
    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
            Oculto
        </label>
        {!! Form::select('hidden', [ '0'=>'No','1'=>'Si'], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
    </div>
    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
            Tipo
        </label>
        {!! Form::select('type', [ '0'=>'Anime','1'=>'Película','2'=>'Especial','3'=>'Ova','4'=>'Ona','5'=>'Corto' ], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el tipo']) !!}
    </div>
    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
            Estado
        </label>
        {!! Form::select('status', [ '0'=>'Finalizado','1'=>'En emisión' ], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el estado']) !!}
    </div>
    <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2">
            Idioma
        </label>
        {!! Form::select('languaje', [ '0'=>'Japones','1'=>'Latino' ], null, ['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'placeholde'=>'Selecciona el estado']) !!}
    </div>
</div>

<div class="flex flex-wrap -mx-3 mt-6 mb-4">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
            Seleccionar Generos
        </label>
        {!! Form::select('genres[]', $genre, null, ['class'=>'select-genero appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500','multiple']) !!}
    </div>
</div>

<div class="flex flex-wrap -mx-3 mt-6 mb-4">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
            Sinopsis de la serie
        </label>
        {!!Form::textarea('description',null,['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white','placeholder'=>'Ingresa el nombre de la serie'])!!}
        <!--p class="text-red-500 text-xs italic">Please fill out this field.</p-->
    </div>
</div>

<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-3/6 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
            Cover
        </label>
        {!!Form::file('cover',['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
    </div>
    <div class="w-full md:w-3/6 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-city">
            Banner
        </label>
        {!!Form::file('banner',['class'=>'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500'])!!}
    </div>
</div>

<div class="container mx-auto pt-5 mb-6">
    <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Registrar
    </button>
</div>