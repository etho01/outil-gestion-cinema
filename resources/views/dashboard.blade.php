@extends('layouts.app')

@section('content')
    <div class="p-5  row">
        <div class="fs-1 d-flex justify-content-center">
            Bienvenue sur {{ config('app.name', 'Laravel') }}<br>
        </div>

        <div class="fs-2 pt-4">
            Veuillez selectionner un cinema :
        </div>
        <div class="ms-5 fs-3 pt-2 d-flex row">
            @foreach ($listCinema as $client)
                @foreach ($client as $cinema)
                    @if ($cinema->canAcceesCinema())
                        <a href="{{route($cinema->getPageAcceuilCinema(), ['cinema' => $cinema->slug])}}" class="text-black px-3">{{ $cinema->nom }}</a>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
