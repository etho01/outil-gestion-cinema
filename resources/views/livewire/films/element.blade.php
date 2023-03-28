
<div class="modal-content" wire:key="{{ $typeElement.$idElement }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Créer une version d\'un film ': 'Modifier une version d\'un film'}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">
            <div class="d-flex row">
                <div class="col-6">
                    <img class="img-fluid" src="{{$urlImage}}" alt="">
                </div>
                <div class="col-6">
                    <x-input.text name="nomVersion" champLivewire="nomVersion" label="Nom de la version du film" placeholder="Nom de la version du film"/>
                    
                    <x-input.select champLivewire="distributeur" name="distributeur" label="Distributeur" :elements="$listeDistrib"/>

                    <div class="dropdown">
                        <a class="btn " href="#" role="button" id="dropDownSelectFilm" data-bs-toggle="dropdown" aria-expanded="false">
                          Film {{ $nomFilm }}
                        </a>
                        <button wire:click="changeFilm" id="idBtnModal" style="display: none"></button>
                        <ul class="dropdown-menu" aria-labelledby="dropDownSelectFilm">
                            <livewire:films.element.liste-film  :idElement="$idElement"/>
                        </ul>
                        @error('nomFilm')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    <x-input.select champLivewire="formatSon" name="formatSon" label="Format du son" :elements="$listeFormatSon"/>
                    <x-input.select champLivewire="formatImage" name="formatImage" label="Format de l'image" :elements="$listeFormatImage"/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        @if ($idElement == 0)
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" wire:click="create()" class="btn btn-primary">Créer le film</button>
        @else
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
            <button type="button" wire:click="save()" class="btn btn-primary">Sauvegarder</button>
        @endif
    </div>
</div>
