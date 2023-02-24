<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$sceance" :infostable="$infostable" :idCinema="$idCinema" :livewireObject="$livewireObject"
             :importOtherPopUp="$importOtherPopUp"/>
        </div>
        <div class="card-footer">
            {{ $sceance->links() }}
        </div>
    </div>
</div>
