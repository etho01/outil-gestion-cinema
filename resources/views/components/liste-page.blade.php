<div class="bg-dark menu-slide" style="width: 200px">
    <div class="d-flex flex-columns justify-content-center p-2 bg-dark">
        <div class="fs-1 border-bottom text-white pb-2 text-center">{{ config('APP_NAME', 'Laravel') }}</div>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        @foreach($TAB_CATEGORIES_PAGES as $key => $CATEGORIES_PAGES)
            @if ($CATEGORIES_PAGES['nb'] == 1)
                <li >
                    <a class="nav-link text-white p-3" href="#{{$CATEGORIES_PAGES['pages']->get(0)->route}}">
                        <i class="{{ $CATEGORIES_PAGES['icone'] }}">
                            {{ $CATEGORIES_PAGES['nom'] }}
                        </i>
                    </a>
                </li>
            @elseif($CATEGORIES_PAGES['nb'] > 1)
                <li class="">
                    <a class="nav-link text-white p-3" href="#" data-bs-toggle="collapse" data-bs-target="#menu-{{ $key }}">
                        <i class="{{ $CATEGORIES_PAGES['icone'] }}">
                            {{ $CATEGORIES_PAGES['nom']}}
                        </i>
                    </a>
                    <div class="collapse" id="menu-{{ $key }}">
                        <ul class="nav nav-pills flex-column mb-auto">
                            @foreach($CATEGORIES_PAGES['pages'] as $PAGE)
                                <li class="w-100">
                                    <a class="nav-link text-white w-100" href="{{ $PAGE->route }}">
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

</div>