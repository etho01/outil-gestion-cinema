
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

                    <x-utils.select-scearch :baseType="$typeElement" type="films_sceance" :idElement="$idElement" texteBtn="Version de la sceance : {{$nomFilmSceance}}" 
                        fonctCall="updateFilmSceance" label="Nom de la version du filtre" ouverturePopUp="films_sceance" :idElementPopUp="$idFilmSceance"
                        :idCinema="$idCinema" texteBtnUpdate="une version de film"/>

                        <div class="d-flex row">
                            <div class="col-6">
                                <x-input.text type="date" name="dateSeance" champLivewire="dateSeance" label="date du film" />
                            </div>
                            <div class="col-6">
                                <x-input.text type="time" name="heureSeance" champLivewire="heureSeance" label="heure du film" />
                            </div>
                        </div>

                        <x-input.select :elements="$salles" :defaultValue="$salleActuel" name="salleId" champLivewire="salleId" label="Salle" />

                        <x-input.select :elements="$OptionOuiNon" :defaultValue="$isVisibleSite" name="isVisibleSite" champLivewire="isVisibleSite" label="Est visible sur le site" />
                        
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
