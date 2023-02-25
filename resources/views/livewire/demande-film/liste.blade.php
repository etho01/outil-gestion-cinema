<div>

    <div class="card overflow-visible w-100">
        <div class="card-body">
            <x-gestion.table :typesclient="$demandes" :infostable="$infostable" :idCinema="$idCinema"/>
        </div>
        <div class="card-footer">
            {{ $demandes->links() }}
        </div>
    </div>
</div>
