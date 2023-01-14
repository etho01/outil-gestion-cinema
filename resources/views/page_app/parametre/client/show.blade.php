@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ $infosPage->getRoute("Client.create") }}" method="POST">
            <div class="card-body">
                @csrf
                @if($infosPage->isNewElement())
                    <input type="hidden" name="id", value="0">
                @else 
                    <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
                @endif
                <x-layout.sub-title title="Information generaux" />
                <div class="d-flex row">
                    <x-input.text label="Nom du client" name="nom" class="col-8" placeholder="Nom du Client" value="{{ old('nom') ?? $infosPage->getInfosInstance('nom') }}"/>
                    <x-input.select class="col-4" name="type_client" :elements="$typeClient" label="Type du client"/>
                    <x-input.text label="Email" name="email" class="col-12" placeholder="Email" value="{{ old('email') ?? $infosPage->getInfosInstance('email') }}"/>
                </div>
                @error('nom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('type_client')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <x-layout.sub-title title="Information sur les cinemas et les salles du client" />
                <livewire:parametre.client.liste-cinema  :idClient="$infosPage->getInfosInstance('id')"/>
            </div>
            <div class="card-footer d-flex justify-element-end">
                <input type="submit" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
            </div>
        </form>
    </div>
@endsection
