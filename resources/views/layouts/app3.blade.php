<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- bootstrap --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                    {{ config('app.name' , 'Laravel') }} Layout 3
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">

						<li class="nav-item">
                            <a class="nav-link" href="{{ route('request') }}"> Request </a>
                        </li>

						<li class="nav-item">
                            <a class="nav-link" href="{{ route('auth') }}"> Auth </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('session') }}"> Session </a>
                        </li>

                    </ul>


                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->

                        @guest

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>

                        @else

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">{{ 'Modul user' }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('role.index') }}">{{ 'Modul role' }}</a>
                            </li>

                            <li class="nav-item dropdown">

                                <a 		id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                	 	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a 	 class="dropdown-item" 		href="{{ route('logout') }}"
                                       	 onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>

        </nav>




		<div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">

                {{ config('app.name' , 'Laravel') }} Layout 33
            </a>


            <div>

                <!-- Right Side Of Navbar -->

                <ul class="navbar-nav ">

                    <!-- Authentication Links -->
<?php
    $user   =   \Session::get('user');

    if(! $user){
?>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login3') }}">{{ __('Login') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register2') }}">{{ __('Register') }}</a>
                    </li>
<?php
    }
    else{
?>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user3.index') }}">{{ 'Modul user' }}</a>
                    </li>

                    <li class="nav-item">
{{--                        <a class="nav-link" href="{{ route('role3.index') }}">{{ 'Modul role' }}</a>	--}}
                    </li>

                    <li class="nav-item dropdown">

                        <a 		id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        	 	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            {{ $user->email }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" >

                            <a 	 class="dropdown-item"
                               	 onclick="event.preventDefault();
                                 document.getElementById('logout-form2').submit();">

                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form2" action="{{ route('logout3') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
<?php
    }
?>
                </ul>
            </div>
            
<?php 
    
    if(session('message')){
?>
    		<div class='py-4' style='color: red'>
            	<p>{{ session('message') }}</p>
            </div>
<?php 
    }
?>
        </div>
        
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
