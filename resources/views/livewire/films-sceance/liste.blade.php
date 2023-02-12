<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$films" :infostable="$infostable" :livewireObject="$livewireObject" :idCinema="$idCinema"/>
        </div>
        <div class="card-footer">
            {{ $films->links() }}
        </div>
    </div>
</div>
