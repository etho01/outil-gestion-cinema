<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none">
        Launch demo modal
    </button>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <livewire:parametre.distributeur.element :idElement="$elementUpdate" :idCinema="$idCinema"/>
                            
        </div>
    </div>
</div>