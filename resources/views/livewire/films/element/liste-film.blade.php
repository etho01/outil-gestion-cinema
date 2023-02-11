<div>
    <li class="m-2"> 
        <x-input.text name="nomFilm" label="Nom du film" placeholder="Nom du film" champLivewire="nom"/>
    </li>
    @if ($sizeNom < 4)
        <li class="m-2">
            Veillez entré un minimun de 4 caracteres
        </li>
    @else
        @foreach ($films as $film)
        <li class="m-2" wire:click="refresh({{$film['id']}})" onclick="document.getElementById('idBtnModal{{$idElement}}').setAttribute('wire:click', 'changeFilm({{$film['id']}}, \'{{htmlspecialchars( $film['title'])}}\')');
            document.getElementById('idBtnModal{{$idElement}}').click() ">
            {{ $film['title'] }}
        </li>
        @endforeach
    @endif
</div>