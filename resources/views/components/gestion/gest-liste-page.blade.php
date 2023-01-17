<div class="">
        @foreach($listeCategoriePage as $nom_categorie => $listePages)
        <div class="w-50">
            <x-layout.part-title :title="$nom_categorie" />
        </div>
                <div class="d-flex row">
                    @foreach($listePages as $page)
                        <div class="col-6 p-2">
                            <x-input.checkbox :nom="$page->nom" :id="$page->id" enable="{{ $listPageEnable->contains($page->id) }}" prefix="page_"/>
                        </div>
                    @endforeach
                </div>
        @endforeach
</div>