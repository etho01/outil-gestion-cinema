
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Créer une version d\'un film pour une sceance': 'Modifier une version d\'un film pour une sceance'}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">
            <div class="d-flex row">
                <div class="col-6">
                    <img class="img-fluid" src="{{$urlImage}}" alt="">
                </div>
                <div class="col-6">
                    <x-input.text name="nomFilmSceance" champLivewire="nomFilmSceance" label="Nom du film pour la sceance" placeholder="Nom du film pour la sceance"/>

                    <x-utils.select-scearch :elements="$listeFilmBase" type="listeFilm" :idElement="$idElement" texteBtn="Version du film : {{$nomFilmVersion}}" 
                        fonctCall="updateFilmBase" label="Nom de la version du filtre" ouverturePopUp="films" :idElementPopUp="$idFilmVersion"
                        :idCinema="$idCinema" texteBtnUpdate="une version de film"/>

                    <x-input.select champLivewire="filtreLangue" name="filtreLangue" label="Filtre sur la langue" :elements="$listeLangue"/>
                    <x-input.select champLivewire="filtreDim" name="filtreDim" label="Dimention du film" :elements="$listeDim"/>
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
