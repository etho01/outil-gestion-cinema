<div class="card filtre mb-3">
    <div class="d-flex flex-row p-3">
        @foreach ($filtres as $filtre)
            @if ($filtre['type'] == 'text')
                <input type="text" class="form-control" placeholder="{{ $filtre['placeholder'] }}">
            @endif
        @endforeach
    </div>
</div>