<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$distributeur" :infostable="$infostable"/>
        </div>
        <div class="card-footer">
            {{ $distributeur->links() }}
        </div>
    </div>
</div>
