<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$stockage" :infostable="$infostable" :livewireObject="$livewireObject" :idCinema="$idCinema" :useModal="$useModal"
            :option="$option"
            />
        </div>
        <div class="card-footer">
            {{ $stockage->links() }}
        </div>
    </div>
</div>
