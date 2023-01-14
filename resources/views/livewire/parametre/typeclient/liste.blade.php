<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$typesclient" :route="$route" :infostable="$infostable" :infosPage="$infosPage"/>
        </div>
        <div class="card-footer">
            {{ $typesclient->links() }}
        </div>
    </div>
</div>
