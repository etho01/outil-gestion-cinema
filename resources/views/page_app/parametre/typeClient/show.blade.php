@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ $infosPage->getRoute("TypeClient.create") }}" method="POST">
            <div class="card-body p-5">

                @csrf
                @if($infosPage->isNewElement())
                    <input type="hidden" name="id", value="0">
                @else 
                    <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
                @endif
                <x-layout.title-page title="Informations sur le type du client" />
                <x-layout.sub-title title="Informations généraux" />

                
                <x-input.text name="nom" placeholder="nom" value="{{ old('nom') ?? $infosPage->getInfosInstance('nom') }}" />
                <x-layout.sub-title title="Gestion des pages" />
                <x-gestion.gest-liste-page :listPageAutorized="$listPageAutorized" :listPagesEnable="$listPagesEnable" />

            </div>
            <div class="card-footer d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
            </div>
        </form>
    </div>
@endsection
