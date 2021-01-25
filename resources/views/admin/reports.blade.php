@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-12">
        <div class="option-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Capítulos reportados
            </h2>
            <div class="grid grid-cols-1 mt-4">
                <table class="table-fixed w-full">
                    <thead class="border bg-green-600">
                        <tr>
                            <th class="border w-1/3 px-4 py-2">Capitulo</th>
                            <th class="border w-1/3 px-4 py-2">Reporte</th>
                            <th class="border w-1/3 px-4 py-2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a class="hover:bg-orange-600" href="{{ action('FrontController@view', [$report->capitulo['slug']]) }}">
                                        {{$report->capitulo['name']}} capítulo {{$report->capitulo['number']}}
                                    </a>
                                </td>
                                <td class="border px-4 py-2">{{$report['report']}}</td>
                                <td class="border px-4 py-2">
                                    {!!Form::open(['route'=>['report.destroy',$report->id],'method'=>'DELETE'])!!}
                                        <button class="bg-orange-600 rounded-full px-2 hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection