<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/1f8f01d002.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="vh-100 vh-100 d-flex flex-row">

    <div class="w-25 bg-dark">
        <div class="d-flex flex-column ">
            <div></div>
        </div>
    </div>
    <div class="w-100">
        <header class="container-fluid menu d-flex justify-element-boder">
            <div class="d-flex flex-row justify-content-between mx-2">
                <div>
                    {{ config('APP_NAME', 'Laravel') }}
                </div>
                <x-liste-page />
                    <div>
                    @auth
                    <div class="dropdown">
                        <button id="dropDownUser" class="btn"  data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropDownUser">
                            <li class="dropdown-item">
                                <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Deconnection</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>        
                    </div>
                        
                    @else
                    gest
                    @endauth
                </div>
            </div>

        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
