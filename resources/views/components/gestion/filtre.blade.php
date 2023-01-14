<div class="card filtre mb-3">
    <div class="d-flex row p-3">
        @foreach ($filtres as $filtre)
                @if ($filtre['type'] == 'text')
                    <x-input.text :placeholder="$filtre['placeholder']" :label="$filtre['label']" :name="$filtre['name']" :class="$filtre['class']" :champLivewire="$filtre['champLivewire']"/>
                @elseif($filtre['type'] == 'select')
                    <x-input.select :filtre="$filtre"/>
                @endif
        @endforeach
    </div>
</div>