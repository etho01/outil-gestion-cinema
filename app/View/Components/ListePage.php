<?php

namespace App\View\Components;

use App\Models\page\Page;
use Illuminate\View\Component;
use App\Models\page\CategoriePage;

class ListePage extends Component
{

    public $infosPage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($infosPage)
    {
        $this->infosPage = $infosPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.liste-page', [
            'TAB_CATEGORIES_PAGES' => Page::getPageAndCategorieWherePageIn(Page::whereNull('page_parent')->pluck('id')),
            'infosPage' => $this->infosPage
        ]);
    }
}
