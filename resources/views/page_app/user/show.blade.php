@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ $infosPage->getRoute("User.create") }}" method="POST">
            <div class="card-body p-5">
                @csrf
                @if($infosPage->isNewElement())
                    <input type="hidden" name="id", value="0">
                @else 
                    <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
                @endif
                <x-layout.sub-title title="Nom" />
                <div class="d-flex row">
                    <x-input.text name="nom" label="nom du gestionnaire" class="col-12" placeholder="nom du gestionnaire" value="{{ old('nom') ?? $infosPage->getInfosInstance('nom') }}"/>
                    <x-input.text name="email" label="email du gestionnaire" class="col-12" placeholder="email du gestionnaire" 
                        value="{{ old('email') ?? $infosPage->getInfosInstance('email') }}"/>
                </div>

                <x-gestion.list-role :idClient="$infosPage->instanceCinema->client_id" :idUser="$infosPage->getInfosInstance('id')"/>
                
            </div>

            <div class="card-footer d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
            </div>
        </form>
    </div>
@endsection
