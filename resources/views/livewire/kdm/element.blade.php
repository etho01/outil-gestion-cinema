
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Créer une KDM': 'Modifier une KDM'}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">
            <div class="d-flex row">
                <div class="col-md-6 col-12 mr-1">
                    <x-input.text type="date" name="dateDebut" champLivewire="dateDebut" label="date de debut de la KDM" />
                </div>
                <div class="col-md-6 col-12 ml-1">
                    <x-input.text type="date" name="dateFin" champLivewire="dateFin" label="date de fin de la KDM" />
                </div>
            </div>

            <x-input.select name="cinemaId" :elements="$salles" label="Salle" champLivewire="idSalle" />

                    <x-utils.select-scearch :baseType="$typeElement" type="films_sceance" :idElement="$idElement" texteBtn="Version de la sceance : {{$nomFilmSceance}}" 
                        fonctCall="updateFilmSceance" label="Nom de la version du filtre" ouverturePopUp="films_sceance" :idElementPopUp="$idFilmSceance"
                        :idCinema="$idCinema" texteBtnUpdate="une version de film"/>

        </div>
    </div>
    <div class="modal-footer">
        @if ($idElement == 0)
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" wire:click="create()" class="btn btn-primary">Créer la Kdm</button>
        @else
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
            <button type="button" wire:click="save()" class="btn btn-primary">Sauvegarder</button>
        @endif
    </div>
</div>
