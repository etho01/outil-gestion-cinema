<div>
    <li class="m-2"> 
        <x-input.text name="filtre" :label="$label" :placeholder="$label" champLivewire="filtre"/>
    </li>

    <li class="dropdown-item @if ($idSelect == 0) active @endif" wire:click="refresh({{0}})" 
        onclick="document.getElementById('idBtnModal{{ $type }}{{$idElement}}').setAttribute('wire:click', '{{ $foncCall }}(\'{{0}}\')');
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').click()">
            --
    </li>

    @foreach ($elementsFiltre as $element)
        <li class="dropdown-item @if ($idSelect == $element->id) active @endif" wire:click="refresh({{$element->id}})" 
        onclick="document.getElementById('idBtnModal{{ $type }}{{$idElement}}').setAttribute('wire:click', '{{ $foncCall }}(\'{{$element->id}}\')');
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').click() ">
            {{ $element->nom }}
        </li>
        @endforeach
    @if ($type == "films")
    <script>
        window.addEventListener('updateFilm{{$idSelect}}', e => {
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').setAttribute('wire:click', '{{ $foncCall }}(\'{{$idSelect}}\')');
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').click() 
        });
    </script>
    @elseif($type == "films_sceance")
    <script>
        window.addEventListener('updateFilmSeance{{$idSelect}}', e => {
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').setAttribute('wire:click', '{{ $foncCall }}(\'{{$idSelect}}\')');
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').click() 
        });
    </script>
    @endif
</div>
