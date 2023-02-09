<div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$livewireObject}}{{$elementUpdate}}" style="display: none">
        Launch demo modal
    </button>

    @if ($livewireObject == "distributeur")
        <x-popup.updatemodel.parametre.distributeur :elementUpdate="$elementUpdate" :idCinema="$idCinema" :livewireObject="$livewireObject"/>
    @elseif($livewireObject == "option")
        <x-popup.updatemodel.parametre.option :elementUpdate="$elementUpdate" :idCinema="$idCinema" :livewireObject="$livewireObject"/>
    @endif

    <script>
        window.addEventListener('showModal{{$livewireObject.$elementUpdate}}', e => {
            toggleModal('{{$livewireObject}}', {{$elementUpdate}});
        });

        window.addEventListener('hideModal{{$livewireObject.$elementUpdate}}', e => {
            toggleModal('{{$livewireObject}}', {{$elementUpdate}});
        });
    </script>
</div>