<div>
    <li class="m-2"> 
        <x-input.text name="filtre" :label="$label" :placeholder="$label" champLivewire="filtre"/>
    </li>
    @foreach ($elementsFiltre as $element)
        <li class="dropdown-item" wire:click="refresh({{$element->id}})" 
        onclick="document.getElementById('idBtnModal{{ $type }}{{$idElement}}').setAttribute('wire:click', '{{ $foncCall }}(\'{{$element->id}}\')');
            document.getElementById('idBtnModal{{ $type }}{{$idElement}}').click() ">
            {{ $element->nom }}
        </li>
        @endforeach
</div>