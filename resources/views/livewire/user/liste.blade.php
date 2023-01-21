<div>
    <x-gestion.filtre :filtre="$filtre"/>

    <div class="card">
        <div class="card-body">
            <x-gestion.table :typesclient="$users" :route="$route" :infostable="$infostable"/>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
</div>
