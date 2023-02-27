
<div class="modal-content" wire:key="{{ $typeElement.$idElement }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Créer une option ': 'Modifier une option'}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">
            <x-input.text name="nom" champLivewire="nom" label="Nom de l'option" placeholder="Nom de l'option"/>

            <x-input.select name="visibilite" champLivewire="visibilite" change="changeType" label="Visibilite de l'option" :elements="$visibiliteOption"/>
            @if ($visibilite != "")
                <x-input.select name="type" champLivewire="type" label="Type de l'option" :elements="$typeOption"/>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        @if ($idElement == 0)
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" wire:click="create()" class="btn btn-primary">Créer l'option</button>
        @else
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
            <button type="button" wire:click="save()" class="btn btn-primary">Sauvegarder</button>
        @endif
    </div>
</div>
