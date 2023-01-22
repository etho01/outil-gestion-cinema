@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="card m-5">
            <form action="{{ route('profile.change') }}" method="POST">
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

                    <x-layout.sub-title title="Mot de passe" />
                    <div class="w-25 m-auto">
                        <label for="password">Mot de passe</label>
                        <input class="form-control" type="password" name="password" id="password" required placeholder="Mot de passe">
                        @error('password')
                            <div class="px-5 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <label for="Checkpassword" class="mt-3">retaper le mot de passe </label>
                        <input class="form-control" type="password" name="Checkpassword" id="Checkpassword" required placeholder="Mot de passe">
                        @error('Checkpassword')
                            <div class="px-5 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" value="{{ $infosPage->isNewElement() ? 'Crée' : 'Modifier' }}">
                </div>
            </form>
        </div>
    </div>
@endsection
