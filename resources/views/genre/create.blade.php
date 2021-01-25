@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Agregar Genero
            </h2>

            <div class="pt-16">
                <form class="w-full" method="POST" action="{{route('genre.store')}}">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Nombre del genero
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Nombre del genero" name="name">
                        </div>
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Color del boton
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Color que se mostrara en el boton" name="color">
                        </div>
                    </div>

                    <div class="container mx-auto pt-5">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Registrar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection