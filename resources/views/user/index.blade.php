@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-12">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Usuarios registrados
            </h2>
            @if (auth()->user()->role == 0)
                <div class="grid grid-cols-1">
                    <div class="mt-2 mb-2">
                        <a href="{{ route('user.create') }}">
                            <div class="w-full bg-purple-700 block hover:bg-purple-800 rounded-lg">
                                <p class="px-4 py-2 text-center lg:text-sm md:text-xs uppercase">
                                    Registar usuario
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-1 mt-4">
                <table class="table-fixed w-full">
                    <thead class="border bg-green-600">
                        <tr>
                            <th class="border w-1/3 px-4 py-2">Usuario</th>
                            <th class="border w-1/3 px-4 py-2">Tipo</th>
                            @if (auth()->user()->role == 0)
                                <th class="border w-1/3 px-4 py-2">Opciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2 text-center">
                                    {{$user['name']}}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    @if($user->role == 0)
                                        Super Admin
                                    @elseif($user->role == 1)
                                        Admin
                                    @elseif($user->role == 2)
                                        Uploader
                                    @elseif($user->role == 3)
                                        Regular User
                                    @endif
                                </td>
                                @if (auth()->user()->role == 0)
                                    <td class="border px-4 py-2">
                                        <div>
                                            <a href="{{ route('user.edit', [$user['id']]) }}" class="text-xs text-center font-bold bg-orange-600 uppercase px-2 py-1 shadow-lg block leading-normal cursor-pointer hover:bg-orange-400 hover:text-black mt-2 mb-2">
                                                editar
                                            </a>
                                            {!!Form::open(['route'=>['user.destroy',$user->id],'method'=>'DELETE'])!!}
                                                <button class="mt-2 mb-2 text-xs font-bold bg-red-600 uppercase px-2 py-1 shadow-lg block w-full leading-normal cursor-pointer hover:bg-red-400 hover:text-black">
                                                    eliminar
                                                </button>
                                            {!!Form::close()!!}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection