
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Inserer un Film': 'Modifier l\'insertion d\'un film'}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">

            <x-input.select name="type" :elements="$Listetype" label="Stockage" champLivewire="type"  :disable="$disableType"/>

            <x-input.select name="idSalle" :elements="$salles" label="Salle" champLivewire="idSalle" />

                    <x-utils.select-scearch :baseType="$typeElement" type="films_sceance" :idElement="$idElement" texteBtn="Version de la séance : {{$nomFilmSceance}}" 
                        fonctCall="updateFilmSceance" label="Nom de la version du filtre" ouverturePopUp="films_sceance" :idElementPopUp="$idFilmSceance"
                        :idCinema="$idCinema" texteBtnUpdate="une version de film"/>

                    @error('idFilmSceance')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

        </div>
    </div>
    <div class="modal-footer">
        @if ($idElement == 0)
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="button" wire:click="create()" class="btn btn-primary">Inserer le film</button>
        @else
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
            <button type="button" wire:click="save()" class="btn btn-primary">Sauvegarder</button>
        @endif
    </div>
</div>
