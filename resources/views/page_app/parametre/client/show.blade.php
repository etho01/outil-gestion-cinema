@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ $infosPage->getRoute("Client.create") }}" method="POST">
            <div class="card-body p-5">
                @csrf
                @if($infosPage->isNewElement())
                    <input type="hidden" name="id", value="0">
                @else 
                    <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
                @endif
                <x-layout.sub-title title="Information generaux" />
                <div class="d-flex row">
                    <x-input.text label="Nom du client" name="nom" class="col-8" placeholder="Nom du Client" value="{{ old('nom') ?? $infosPage->getInfosInstance('nom') }}"/>
                    <x-input.select class="col-4" name="type_client" :elements="$typeClient" label="Type du client" defaultValue="{{old('type_client') ?? $infosPage->getInfosInstance('types_client_id')}}"/>
                    <x-input.text label="Email" name="email" class="col-12" placeholder="Email" value="{{ old('email') ?? $infosPage->getInfosInstance('email') }}"/>
                </div>
                <x-layout.sub-title title="Information sur les cinemas et les salles du client" />

                @error('cinemaError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <livewire:parametre.client.liste-cinema  :idClient="$infosPage->getInfosInstance('id')" :datasUpdateCine="old('datasUpdateCine') ?? ''"/>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="{{ $infosPage->isNewElement() ? 'Créer' : 'Modifier' }}">
            </div>
        </form>
    </div>
@endsection
