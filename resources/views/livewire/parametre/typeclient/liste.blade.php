<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$typesclient" :route="$route" :infostable="$infostable"/>
        </div>
        <div class="card-footer">
            {{ $typesclient->links() }}
        </div>
    </div>
</div>
