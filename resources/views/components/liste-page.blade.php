<div class="bg-dark menu-slide d-flex flex-column menu-bar liste-page" style="width: 200px; height :100%; overflow-y: auto;">
    <div class="d-flex flex-columns justify-content-center p-2 bg-dark">
        <div class="fs-1 border-bottom text-white pb-2 text-center">{{ config('APP_NAME', 'Laravel') }}</div>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        @foreach($TAB_CATEGORIES_PAGES as $key => $CATEGORIES_PAGES)
            @if ($CATEGORIES_PAGES->count() == 1)
                <li>
                    <a class="nav-link text-white p-3
                    @if($CATEGORIES_PAGES->get(0)->categorie_page_id == $infosPage->page->categorie_page_id) active @endif " 
                    href="{{$infosPage->getRoute($CATEGORIES_PAGES->get(0)->route) }}">
                        <i class="{{ $CATEGORIES_PAGES->get(0)->icone_categorie }}">
                            {{ $key }}
                        </i>
                    </a>
                </li>
            @elseif($CATEGORIES_PAGES->count() > 1)
                <li class="">
                    <a class="nav-link text-white p-3 
                    @if($CATEGORIES_PAGES->get(0)->categorie_page_id == $infosPage->page->categorie_page_id) active @endif " 
                     href="#" data-bs-toggle="collapse" data-bs-target="#menu-{{ $key }}">
                        <i class="{{ $CATEGORIES_PAGES->get(0)->icone_categorie }}">
                            {{ $key }}
                        </i>
                    </a>
                    <div class="collapse
                    @if($CATEGORIES_PAGES->get(0)->categorie_page_id == $infosPage->page->categorie_page_id) show @endif " 
                     id="menu-{{ $key }}">
                        <ul class="nav nav-pills flex-column mb-auto">
                            @foreach($CATEGORIES_PAGES as $PAGE)
                                <li class="w-100">
                                    <a class="nav-link text-white w-100
                                    @if($PAGE->id == $infosPage->page->id) active @endif " 
                                    " href="{{ $infosPage->getRoute( $PAGE->route) }}">
                                        {{ $PAGE->nom }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endIf
        @endforeach
    </ul>
    <a href="#" class="nav-link text-white p-3" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>Cinemas</strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
        @if ($listCinema->count() == 1)
            @foreach ($listCinema->first() as $cinema)
                <li class=""  href="{{route('Film.list', ['cinema' => $cinema->slug])}}"> 
                    <a href="{{route('Film.list', ['cinema' => $cinema->slug])}}" class="nav-link text-white px-3 py-1">{{ $cinema->nom }}</a>
                </li>
            @endforeach
        @else
            @foreach($listCinema as $nomClient => $client)
                <li class="dropdown-submenu">
                    <a class="nav-link text-white px-3" href="#">{{ $nomClient }}</a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @foreach ($client as $cinema)
                            <li class=""  href="{{route('Film.list', ['cinema' => $cinema->slug])}}"> 
                                <a href="{{route('Film.list', ['cinema' => $cinema->slug])}}" class="nav-link text-white px-3">{{ $cinema->nom }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        @endif
    </ul>

</div>