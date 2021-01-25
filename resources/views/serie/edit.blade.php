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
                Editar Serie
            </h2>

            <div class="pt-6">
                {!!Form::model($serie,['route'=>['serie.update',$serie],'method'=>'PUT','files'=>true, 'class'=>'w-full'])!!}
                    
                    @include('serie.form.form')

                {!!Form::close()!!}
            </div>

        </div>
    </div>

@endsection