<div class="mt-5 p-3">
    <x-layout.sub-title title="gestion des pages" />

        <ul class="nav nav-pills" id="myTab" role="tablist">

            @foreach($listeCategoriePage as $nom_categorie => $listePages)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-{{ $nom_categorie }}" data-bs-toggle="tab" data-bs-target="#{{ $nom_categorie }}" 
                    type="button" role="tab" aria-selected="true">{{ $nom_categorie }}</button>
                </li>
            @endforeach
        </ul>
      <div class="tab-content">
        @foreach($listeCategoriePage as $nom_categorie => $listePages)
            <div class="tab-pane fade p-3" id="{{ $nom_categorie }}" role="tabpanel">
                <div class="d-flex row">
                    @foreach($listePages as $page)
                        <div class="col-6 p-2">
                            <x-input.checkbox :nom="$page->nom" :id="$page->id" enable="{{ $listPageEnable->contains($page->id) }}" prefix="page_"/>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
      </div>
</div>