<div class="text-start">
    <?php 
    if(!isset($option)) $option = '';
    if(!isset($isUpdated)) $isUpdated = false;
    ?>

    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modal{{$livewireObject}}" style="display: none">
        Launch demo modal
    </button>
 
    <input type="hidden" id="modalParent{{$livewireObject}}">

    @if ($livewireObject == "distributeur")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.distributeur.element  :idCinema="$idCinema" :key="time().$livewireObject"  :typeElement="$livewireObject"
                  />
                                
            </div>
        </div>
    @elseif($livewireObject == "option")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.option.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                  />
                                
            </div>
        </div>
    @elseif($livewireObject == "films")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                  :isUpdated="$isUpdated"/>
                                
            </div>
        </div>
    @elseif ($livewireObject == "films_sceance")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films-sceance.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                  :isUpdated="$isUpdated"/>
                                
            </div>
        </div>
        @elseif ($livewireObject == "kdm")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:kdm.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                  />
                                
            </div>
        </div>
        @elseif ($livewireObject == "seance")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:seance.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                  />
                                
            </div>
        </div>
        @elseif ($livewireObject == "stockage")
        <div class="modal fade" id="modal{{$livewireObject}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:stockage.element  :idCinema="$idCinema" :key="time().$livewireObject" :typeElement="$livewireObject"
                   :option="$option"/>
                                
            </div>
        </div>
    @endif

    <script>
        window.addEventListener('showModal{{$livewireObject}}', e => {
            toggleModal('{{$livewireObject}}');
        });

        window.addEventListener('hideModal{{$livewireObject}}', e => {
            toggleModal('{{$livewireObject}}');
        });

        function showModal{{ $livewireObject }}(idElement, idBase){
            toggleModal('{{$livewireObject}}')
            Livewire.emit('showElement{{ $livewireObject }}', idElement, idBase)
        }

        document.getElementById('modal{{$livewireObject}}').addEventListener('hide.bs.modal', function (event) {
            setTimeout(() => {
                 openOldModal('{{$livewireObject}}');
             }, 500);
        })

    </script>
</div>