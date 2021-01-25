@extends('layouts.main')

@section('css')

<style>

    .error-text {
      font-size: 130px;
    }

    @media (min-width: 768px) {
      .error-text {
        font-size: 220px;
      }
    }

</style>
    
@endsection

@section('content')
    
    <div class="container mx-auto px-4 pt-4">
        <div class="h-screen flex justify-center content-center">
            <p class="text-purple-600 error-text">404</p>
            <div class="absolute bottom-0 mb-20 text-white text-center text-xl">
                <span class="opacity-50">Al parecer nos hemos perdido, vuleve al inicio</span>
                <a class="border-b" href="/">Legazy.net</a>
            </div>
        </div>
    </div>

@endsection