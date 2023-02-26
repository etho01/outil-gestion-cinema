<div>
    <input type="hidden" name='datasUpdateCine' value="{{  json_encode($datasUpdateCine)}}">
    <div class="pt-3">
        @foreach ($ListeCinema as $numberCinema => $ListeSalle)
            <div class="d-flex flex-row justify-content-between">
                <div class="input-group">
                    <input type="text" class="form-control" name="{{ 'cine'.$numberCinema }}" id="{{ 'cine'.$numberCinema }}"
                    placeholder="Nom du cinema" wire:model="valueCinema.{{ $numberCinema }}" value="{{$valueCinema[$numberCinema] ?? ''}}">

                    @error('cine'.$numberCinema)
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="button" wire:click="supp_cinema({{$numberCinema}})" class="input-group-text"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le cinema">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="ps-5">
                @foreach ($ListeSalle as $numberSalle => $Salle)
                    
                    <div class="d-flex flex-row justify-content-between pt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="{{ 'salle'.$numberCinema.'-'.$numberSalle }}" 
                            id="{{ 'salle'.$numberCinema.'-'.$numberSalle }}" placeholder="Nom de la salle"
                            value='{{ $valueSalle[$numberCinema][$numberSalle] ?? '' }}'
                            wire:model="valueSalle.{{ $numberCinema }}.{{ $numberSalle }}" />

                            @error('salle'.$numberCinema.'-'.$numberSalle)
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="button" wire:click="supp_salle({{$numberCinema}}, {{ $numberSalle }})" class="input-group-text"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="supprimer la salle">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
                <input type="button" class="btn w-100 btn-secondary my-3" value="ajouter un salle" wire:click="add_salle({{ $numberCinema }})">
            </div>
        @endforeach
    </div>
    <input type="button" class="btn w-100 btn-primary" value="ajouter un cinema" wire:click="add_cinema">
</div>
