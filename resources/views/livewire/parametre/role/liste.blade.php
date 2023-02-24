<div>
    <x-gestion.filtre :filtres="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$roles" :route="$route" :infostable="$infostable"/>
        </div>
        <div class="card-footer">
            {{ $roles->links() }}
        </div>
    </div>
</div>
