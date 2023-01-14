<div>
    <div class="pt-3">
        @foreach ($ListeCinema as $numberCinema => $ListeSalle)
            <div class="d-flex flex-row justify-content-between">
                <x-input.text name="{{ 'cine'.$numberCinema }}" placeholder="Nom du cinema" class="w-100" 
                    champLivewire="valueCinema.{{ $numberCinema }}"  :value="$valueCinema[$numberCinema] ?? ''" />
                <input type="button" class="btn" value="supprimer le cinema" wire:click="supp_cinema({{$numberCinema}})">
            </div>
            <div class="px-5">
                @foreach ($ListeSalle as $numberSalle => $Salle)
                    
                    <div class="d-flex flex-row justify-content-between pt-3">
                        <x-input.text name="{{ 'salle'.$numberCinema.'-'.$numberSalle }}" placeholder="Nom de la salle" class="w-100"
                             champLivewire="valueSalle.{{ $numberCinema }}.{{ $numberSalle }}" :value="$valueSalle[$numberCinema][$numberCinema] ?? ''" />
                        <input type="button" class="btn" value="supprimer la salle" wire:click="supp_salle({{$numberCinema}}, {{ $numberSalle }})">
                    </div>
                @endforeach
                <input type="button" class="btn w-100 btn-secondary my-3" value="ajouter un salle" wire:click="add_salle({{ $numberCinema }})">
            </div>
        @endforeach
    </div>
    <input type="button" class="btn w-100 btn-primary" value="ajouter un cinema" wire:click="add_cinema">
</div>
