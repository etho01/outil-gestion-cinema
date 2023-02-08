
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{ $idElement == 0 ? 'Créer la configuration du distributeur ': 'Modifier la configuration du distributeur '}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="d-flex row m-3">
            <label for="nomDistrib"> nom du distributeur</label>
                <input type="text" class="form-control col-12" @if (!$user->isSuperAdmin()) disabled @endif wire:model="nomDistrib"
                 name="nomDistrib" id="nomDistrib" />

                @error('nomDistrib')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="mailDistrib"> email du distributeur</label>
                <input type="text" class="form-control col-12" wire:model="mailDistrib" name="mailDistrib" 
                id="mailDistrib" />
                @error('mailDistrib')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        </div>
    </div>
    <div class="modal-footer">
        @if ($idElement == 0)
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" wire:click="create()" class="btn btn-primary">Créer le distributeur</button>
        @else
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer sans sauvegarder</button>
            <button type="button" wire:click="save()" class="btn btn-primary">Sauvegarder</button>
        @endif
    </div>
</div>
