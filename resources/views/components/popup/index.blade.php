<div class="text-start">

    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modal{{$livewireObject}}{{$elementUpdate}}" style="display: none">
        Launch demo modal
        @if (!isset($idBase)) {{$idBase = 0;  }} @endif
        <?php 
        if(!isset($option)) $option = '';
        if(!isset($isUpdated)) $isUpdated = false;
        ?>
    </button>
 
    <input type="hidden" id="modalParent{{$livewireObject}}{{$elementUpdate}}">

    @if ($livewireObject == "distributeur")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.distributeur.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" 
                :idBase="$idBase" />
                                
            </div>
        </div>
    @elseif($livewireObject == "option")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.option.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate"
                :idBase="$idBase" />
                                
            </div>
        </div>
    @elseif($livewireObject == "films")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate"
                :idBase="$idBase" :isUpdated="$isUpdated"/>
                                
            </div>
        </div>
    @elseif ($livewireObject == "films_sceance")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films-sceance.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" :typeElement="$livewireObject"
                :idBase="$idBase" :isUpdated="$isUpdated"/>
                                
            </div>
        </div>
        @elseif ($livewireObject == "kdm")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:kdm.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" :typeElement="$livewireObject"
                :idBase="$idBase" />
                                
            </div>
        </div>
        @elseif ($livewireObject == "seance")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:seance.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" :typeElement="$livewireObject"
                :idBase="$idBase" />
                                
            </div>
        </div>
        @elseif ($livewireObject == "stockage")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:stockage.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" :typeElement="$livewireObject"
                :idBase="$idBase"  :option="$option"/>
                                
            </div>
        </div>
    @endif

    <script>
        window.addEventListener('showModal{{$livewireObject.$elementUpdate}}', e => {
            toggleModal('{{$livewireObject}}', {{$elementUpdate}});
        });

        window.addEventListener('hideModal{{$livewireObject.$elementUpdate}}', e => {
            toggleModal('{{$livewireObject}}', {{$elementUpdate}});
        });

        document.getElementById('modal{{$livewireObject}}{{$elementUpdate}}').addEventListener('hide.bs.modal', function (event) {
            setTimeout(() => {
                 openOldModal('{{$livewireObject}}', {{$elementUpdate}});
             }, 500);
        })

    </script>
</div>