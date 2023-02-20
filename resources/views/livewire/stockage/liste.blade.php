<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$stockage" :infostable="$infostable" :livewireObject="$livewireObject" :idCinema="$idCinema" :importOtherPopUp="$importOtherPopUp"/>
        </div>
        <div class="card-footer">
            {{ $stockage->links() }}
        </div>
    </div>
</div>
