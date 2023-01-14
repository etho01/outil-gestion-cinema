<div class="card filtre mb-3">
    <div class="d-flex row p-3">
        @foreach ($filtres as $filtre)
                @if ($filtre['type'] == 'text')
                    <x-input.text :placeholder="$filtre['placeholder']" :label="$filtre['label']" :name="$filtre['name']" :class="$filtre['class']" :champLivewire="$filtre['champLivewire']"/>
                @elseif($filtre['type'] == 'select')
                    <x-input.select :class="$filtre['class']" :champLivewire="$filtre['champLivewire']"
                     :label="$filtre['label']" :name="$filtre['name']" :elements="$filtre['elements']" :defaultValue="$filtre['defaultValue']"/>
                @endif
        @endforeach
    </div>
</div>