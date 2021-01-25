@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Ingresar a la aplicacion
            </h2>

            <div class="pt-10">
                <form class="w-full" method="POST" action="{{route('login')}}">
                    {{ csrf_field() }}
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Correo
                            </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="email" placeholder="Ingresa el correo" name="email" value="{{ old('email') }}">
                            {!!$errors->first('email','<span class="mt-2 mb-2">:message</span>')!!}
                        </div>
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-password">
                                Contraseña
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="password" placeholder="********" name="password">
                            {!!$errors->first('password','<span class="mt-2 mb-2">:message</span>')!!}
                        </div>
                    </div>

                    <div class="container mx-auto pt-5">
                        <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ingresar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection