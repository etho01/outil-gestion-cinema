<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ Vite::asset('resources/images/logo.jpg') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/1f8f01d002.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    @livewireStyles
</head>
<body class="vh-100 vh-100 d-flex flex-row">

    <x-liste-page :infosPage="$infosPage" />
    <div class="w-100" style="overflow-y: auto">
        <header class="container-fluid menu d-flex w-100">
            <div class="d-flex flex-row justify-content-between me-2 ms-auto">
                    <div>
                    @auth
                    <div class="dropdown">
                        <button id="dropDownUser" class="btn btn-dark"  data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nom }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropDownUser">
                            <a href="{{ route('profile') }}">
                                <li class="dropdown-item"  >
                                    profil
                                </li>
                            </a>
                            <li class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                Deconnection
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
        <div class="container-fluid pt-3">
            @yield('content')
        </div>
    </div>
    @livewireScripts
    <script>
        function toggleModal(type, idElement){
            var modals = document.querySelectorAll('[data-bs-target="#modal'+type+idElement+'"]');
            modals[0].click();
            
        }
        
        function saveOldModal(oldType, oldIdelement, newType, newIdElement){
            modalIsAnnimationOpen = true;
            document.getElementById('modalParent'+newType+newIdElement).value = "modal"+oldType+oldIdelement;
            setTimeout(() => {
                modalIsAnnimationOpen = false;
            }, 1000);
        }

        var modalIsAnnimationOpen = false;

        var elementUpdated = false;

        window.addEventListener('elementUpdated', e => {
            elementUpdated = true;
        });

        function openOldModal(TypePopUpClose, idPopClose){
            if (!modalIsAnnimationOpen){
                var modalOpen = document.querySelectorAll('[data-bs-target="#'+document.getElementById('modalParent'+TypePopUpClose+idPopClose).value+'"]');
                if (modalOpen[0] != undefined){
                    modalOpen[0].click();
                } else if (elementUpdated){
                    Livewire.emit('saveElement');
                }
            }
        }
    </script>
</body>
</html>
