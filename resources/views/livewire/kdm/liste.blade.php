<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$kdm" :infostable="$infostable" :livewireObject="$livewireObject" :idCinema="$idCinema" :useModal="$useModal"/>
        </div>
        <div class="card-footer">
            {{ $kdm->links() }}
        </div>
    </div>
</div>
