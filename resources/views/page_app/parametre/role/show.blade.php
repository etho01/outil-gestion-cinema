@extends('layouts.app')

@section('content')

<div class="card">
    <form action="{{ $infosPage->getRoute("Role.create") }}">
        @csrf
        @if($infosPage->isNewElement())
            <input type="hidden" name="id", value="0">
        @else 
            <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
        @endif
        <div class="card-body p-5">
            <x-layout.sub-title title="Informations généraux" />
            <div class="d-flew row">
                <x-input.text name="nom" label="Nom du role" placeholder="Nom" value="{{  old('nom') ?? $infosPage->getInfosInstance('nom') }}" class="col-10"/>
                <x-input.select label="Est admin" name="is_admin" 
                :elements="$ListElementAdmin"
                value="{{old('is_admin') ?? $infosPage->getInfosInstance('is_admin')}}" class="col-2"/>
            </div>

            <x-layout.sub-title title="Pages accessible" />

            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                @foreach ($infosPage->instanceCinema()->getCinemaClient()->get() as $key => $cinema)

                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($key == 0) active @endif" id="cinema-{{ $cinema->id }}" data-bs-toggle="pill" data-bs-target="#cinema_{{ $cinema->id }}" type="button" aria-selected="true">
                            {{ $cinema->nom }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($infosPage->instanceCinema()->getCinemaClient()->get() as $key => $cinema)
                 <div class="tab-pane @if ($key == 0) show active @endif" id="cinema_{{ $cinema->id }}">
                    <x-gestion.gest-liste-page :listPageAutorized="$listePageAutorized" 
                        :listPagesEnable="$tabEnable[$cinema->id]"  
                    
                    :idCliema="$cinema->id"/>
                 </div>
                @endforeach
            </div>

        </div>
        <div class="card-footer d-flex justify-content-end">
            <input type="submit" class="btn btn-primary" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
        </div>
    </form>
</div>

@endsection