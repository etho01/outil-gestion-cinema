<?php

namespace App\View\Components;

use App\Models\page\Page;
use App\Models\cinema\Cinema;
use Illuminate\View\Component;
use App\Models\page\CategoriePage;
use Illuminate\Support\Facades\Auth;

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
        $listCinema = Cinema::getCinemaByClientName(Auth::user()->isAdmin());
        return view('components.liste-page', [
            'TAB_CATEGORIES_PAGES' => Page::getPageAndCategorieWherePageIn(Page::getPageAutorized($this->infosPage->isGlobalPage())),
            'infosPage' => $this->infosPage,
            'listCinema' => $listCinema
        ]);
    }
}
