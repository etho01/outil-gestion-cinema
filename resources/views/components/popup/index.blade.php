<div>

    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modal{{$livewireObject}}{{$elementUpdate}}" style="display: none">
        Launch demo modal
    </button>

    <input type="hidden" id="modalParent{{$livewireObject}}{{$elementUpdate}}">

    @if ($livewireObject == "distributeur")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.distributeur.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate"/>
                                
            </div>
        </div>
    @elseif($livewireObject == "option")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:parametre.option.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate"/>
                                
            </div>
        </div>
    @elseif($livewireObject == "films")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate"/>
                                
            </div>
        </div>
    @elseif ($livewireObject == "films_sceance")
        <div class="modal fade" id="modal{{$livewireObject}}{{$elementUpdate}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <livewire:films-sceance.element :idElement="$elementUpdate" :idCinema="$idCinema" :key="$elementUpdate" :typeElement="$livewireObject"/>
                                
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
            openOldModal('{{$livewireObject}}', {{$elementUpdate}});
        })

    </script>
</div>