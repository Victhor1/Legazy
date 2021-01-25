<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{asset('images/legazy/'.'3.png')}}" />
    
    <link rel="stylesheet" href="/css/main.css">
    @yield('css')
    @livewireStyles
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	
	<meta property="og:site_name" content="LEGAZY" />
	<meta name="bm-site-verification" content="eXzniqsznwoHLcHY-_gIEXearRAMo1BdE37ft8SU" />
	@yield('tags')
	
	@guest
	    @foreach($variable as $add)
	        {!!$add->code!!}
	    @endforeach
	@endguest
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123321626-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-123321626-3');
    </script>


    <style>
	
	.duration-200 {
		transition-duration: 200ms;
	}
	.ease-in {
		transition-timing-function: cubic-bezier(0.4, 0, 1, 1);      
	}
	.ease-out {
		transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
	}
	
	.transition {
		transition: transform 250ms ease, color 250ms ease;
	}
	.transform-180 {
		transform: rotate(-180deg);
	}
	
  	</style>

</head>

<body class="font-sans bg-gray-800 text-white">
    
    <script type="text/javascript" data-cfasync="false">
      if(!window.BB_a) { BB_a = [];} if(!window.BB_ind) { BB_ind = 0; } if(!window.BB_vrsa) { BB_vrsa = 'v3'; }if(!window.BB_r) { BB_r = Math.floor(Math.random()*1000000000)} BB_ind++; BB_a.push({ "pl" : 2015268, "index": BB_ind});
    </script>
    <script type="text/javascript" data-cfasync="false">
      document.write('<scr'+'ipt async data-cfasync="false" id="BB_SLOT_'+BB_r+'_'+BB_ind+'" src="//st.bebi.com/bebi_'+BB_vrsa+'.js"></scr'+'ipt>');
    </script>


	<div class="container">
			<nav class="flex items-center justify-between flex-wrap p-6 fixed w-full z-10 top-0"
			x-data="{ isOpen: false }"
			@keydown.escape="isOpen = false"
			:class="{ 'shadow-lg bg-indigo-900' : isOpen , 'bg-gray-900' : !isOpen}"
		>
		
			<!--Logo etc-->
			<div class="flex items-center flex-shrink-0 md:mx-8">
				<a class="text-white no-underline hover:text-white hover:no-underline" href="/">
					<span>
						@include('layouts.svg')
					</span>
				</a>
			</div>

			<!--Toggle button (hidden on large screens)-->
			<button @click="isOpen = !isOpen" type="button" class="block lg:hidden px-2 text-white hover:text-white focus:outline-none focus:text-white bg-purple-600 px-2 py-1 rounded"
				:class="{ 'transition transform-180': isOpen }"
			>
			<svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
				<path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
			</svg>
			</button>
			
			<!--Menu-->
			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto"
				:class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }"
				@click.away="isOpen = false"
				x-show="true"
				x-transition:enter="ease-out duration-200"
				x-transition:enter-start="opacity-0 transform"
				x-transition:enter-end="opacity-100 transform"
				x-transition:leave="ease-in duration-200"
				x-transition:leave-start="opacity-100 transform"
				x-transition:leave-end="opacity-0 transform"
			>

				<ul class="pt-6 lg:pt-0 list-reset lg:flex justify-center flex-1 items-center uppercase bold">
					<li class="mr-3 mb-2">
						<a class="@if(Request::is ('/')) border-b-4 border-blue-600 text-gray-300 @else text-gray-600 hover:text-gray-200 @endif inline-block py-2 px-4" href="/" @click="isOpen = false">Inicio</a>
					</li>
					<li class="mr-3 mb-2">
						<a class="@if(Request::is ('emision')) border-b-4 border-blue-600 text-gray-300 @else text-gray-600 hover:text-gray-200 @endif inline-block py-2 px-4" href="/emision" @click="isOpen = false">Emisi&oacute;n</a>
					</li>
					<li class="mr-3 mb-2">
						<a class="@if(Request::is ('animes')) border-b-4 border-blue-600 text-gray-300 @else text-gray-600 hover:text-gray-200 @endif inline-block py-2 px-4" href="/animes" @click="isOpen = false">Animes</a>
					</li>
					@auth
						@if(auth()->user()->role != 3)
							<li class="mr-3 mb-2">
								<a class="@if(Request::is ('home')) border-b-4 border-blue-600 text-gray-300 @else text-gray-600 hover:text-gray-200 @endif inline-block py-2 px-4" href="/home" @click="isOpen = false">Admin</a>
							</li>
						@endif
					@endauth
				</ul>
				<div class="flex items-center justify-center md:mx-8">
					<livewire:search-dropdown>
				</div>
				
			</div>
			
		</nav>
	</div>

    <div class="container mx-auto mt-20 md:mt-18">
        @yield('content')
	</div>
	
	<!-- component -->
	<footer class="footer bg-gray-900 relative pt-1 mt-4">
		<div class="container mx-auto px-6">
			<div class="mt-2 flex flex-col items-center">
				<div class="sm:w-2/3 text-center py-6">
					<p class="text-sm text-white-700 font-bold mb-2">
						© 2021 LEGAZY
					</p>
					<p class="text-xs text-gray-600">
						Ningun v&iacute;deo se encuentra alojado en nuestros servidores, todos los v&iacute;deos enlazados son tomados de internet, de sitios webs gratuitos.
					</p>
				</div>
			</div>
		</div>
	</footer>
	
	@include('sweetalert::alert')

    <script type="text/javascript" src="{{ asset('plugins/Jquery3.4.1.min.js') }}"></script>
    @yield('js')
    @livewireScripts
    
</body>
</html>