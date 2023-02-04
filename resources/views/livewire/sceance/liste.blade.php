<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$sceance" :infostable="$infostable"/>
        </div>
        <div class="card-footer">
            {{ $sceance->links() }}
        </div>
    </div>
</div>
