@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ $infosPage->getRoute("TypeClient.create") }}" method="POST">
            <div class="card-body">

                @csrf
                @if($infosPage->isNewElement())
                    <input type="hidden" name="id", value="0">
                @else 
                    <input type="hidden" name="id" value="{{ $infosPage->getInfosInstance('id') }}">
                @endif
                <x-layout.title-page title="Informations sur le type du client" />
                <x-layout.sub-title title="Information generaux" />
                <label for="nom" class="form-label">nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="nom" value="{{ old('nom') ?? $infosPage->getInfosInstance('nom') }}" required>
                @error('nom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <x-gestion.gest-liste-page :listPageAutorized="$listPageAutorized" :listPagesEnable="$listPagesEnable" />

            </div>
            <div class="card-footer d-flex justify-element-end">
                <input type="submit" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
            </div>
        </form>
    </div>
@endsection
