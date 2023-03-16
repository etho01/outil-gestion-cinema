<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$sceance" :infostable="$infostable" :idCinema="$idCinema" :livewireObject="$livewireObject"
            :useModal="$useModal"/>
        </div>
        <div class="card-footer">
            {{ $sceance->links() }}
        </div>
    </div>
</div>
