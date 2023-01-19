<div class="">
        @foreach($listeCategoriePage as $nom_categorie => $listePages)
        <div class="w-50">
            <x-layout.part-title :title="$nom_categorie" />
        </div>
                <div class="d-flex row">
                    @foreach($listePages as $page)
                        <div class="col-6 p-2">
                            <x-input.checkbox :nom="$page->nom" :id="$page->id" enable="{{ in_array($page->id, $listPageEnable) }}" prefix="page_{{$idCliema}}_"/>
                        </div>
                    @endforeach
                </div>
        @endforeach
</div>