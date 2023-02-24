<?php

namespace App\View\Components\gestion;

use App\Models\page\Page;
use Illuminate\View\Component;

class gestListePage extends Component
{
    public $listPageAutorized;
    public $listPagesEnable;
    public $idCliema;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listPageAutorized, $listPagesEnable, $idCliema = '')
    {
        $this->listPageAutorized = $listPageAutorized;
        $this->listPagesEnable = $listPagesEnable;
        $this->idCliema = $idCliema;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $listeCategoriePage = Page::getPageAndCategorieWherePageIn($this->listPageAutorized, true);
        if (!is_array($this->listPagesEnable))$this->listPagesEnable = $this->listPagesEnable->pluck('id')->all();
        return view('components.gestion.gest-liste-page',[
            'listeCategoriePage' => $listeCategoriePage,
            'listPagesEnable' => $this->listPagesEnable,
            'idCliema' => $this->idCliema
        ]);
    }
}
