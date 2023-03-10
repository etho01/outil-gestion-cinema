
<div class="p-4">
    <?php 
        use App\Models\page\Page;
        $listeCategoriePage = Page::getPageAndCategorieWherePageIn($listPageAutorized, true);
        if (!is_array($listPagesEnable))$listPagesEnable = $listPagesEnable->pluck('id')->all();
        if (!isset($idCliema)) $idCliema = "";
    ?>
        @foreach($listeCategoriePage as $nom_categorie => $listePages)
            <div class="w-50">
                <x-layout.part-title :title="$nom_categorie" />
            </div>
            <div class="d-flex row px-4">
                @foreach($listePages as $page)
                    <div class="col-12 col-sm-6 col-lg-4 p-2">
                        <x-input.checkbox :nom="$page->nom" :id="$page->id" enable="{{ in_array($page->id, $listPagesEnable) }}" prefix="page_{{$idCliema}}_"/>
                    </div>
                    @foreach ($page->getPageChildren() as $pagesEnfant)
                    <div class="col-12 col-sm-6 col-lg-4 p-2">
                        <x-input.checkbox :nom="$pagesEnfant->nom" :id="$pagesEnfant->id" enable="{{ in_array($pagesEnfant->id, $listPagesEnable) }}" prefix="page_{{$idCliema}}_"/>
                    </div>
                    @endforeach
                @endforeach
            </div>
        @endforeach
</div>