<div>
    <x-gestion.filtre :filtres="$filtre"/>
    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$distributeur" :infostable="$infostable" 
            :livewireObject="$livewireObject" :elementUpdate="$elementUpdate" :idCinema="$idCinema"  :useModal="$useModal"/>
        </div>
        <div class="card-footer">
            {{ $distributeur->links() }}
        </div>
    </div>
</div>
