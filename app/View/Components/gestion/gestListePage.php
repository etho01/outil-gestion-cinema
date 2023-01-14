<?php

namespace App\View\Components\gestion;

use App\Models\page\Page;
use Illuminate\View\Component;

class gestListePage extends Component
{
    public $listPageAutorized;
    public $listPagesEnable;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listPageAutorized, $listPagesEnable)
    {
        $this->listPageAutorized = $listPageAutorized;
        $this->listPagesEnable = $listPagesEnable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $listeCategoriePage = Page::getPageAndCategorieWherePageIn($this->listPageAutorized);

        return view('components.gestion.gest-liste-page',[
            'listeCategoriePage' => $listeCategoriePage,
            'listPageEnable' => $this->listPagesEnable
        ]);
    }
}
