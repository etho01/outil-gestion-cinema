<div class="dropdown">
    <a class="btn mt-2" href="#" role="button" id="dropDownSelectFilm{{ $type }}{{$idElement}}" data-bs-toggle="dropdown" aria-expanded="false" 
        style="border: 1px solid #ced4da; background-color: #f3f4f6;">
      {{ $texteBtn }} 
    </a>
    @isset($ouverturePopUp)
        <button type="button" class="btn mt-2" style="border: 1px solid #ced4da; background-color: #f3f4f6;" 
        type="button" data-bs-toggle="modal" data-bs-target="#modal{{$ouverturePopUp}}{{$idElementPopUp}}" 
        onclick="saveOldModal('{{$baseType}}', {{$idElement}}, '{{$type}}', {{$idElementPopUp}})">
            @if ($idElementPopUp == 0)
                Créer {{$texteBtnUpdate}}
            @else
                Modifier {{$texteBtnUpdate}}
            @endif
        </button>
        
    @endisset
    <button wire:click="changeFilm" id="idBtnModal{{ $type }}{{$idElement}}" style="display: none"></button>
    <ul class="dropdown-menu" aria-labelledby="dropDownSelectFilm{{ $type }}{{$idElement}}" >
        <livewire:utils.select-scearch  :type="$type" :idElement="$idElement" :foncCall="$fonctCall" 
            :label="$label" :idCinema="$idCinema" :idElementPopUp="$idElementPopUp"/>
    </ul>
  </div>