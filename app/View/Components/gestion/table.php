<?php

namespace App\View\Components\gestion;

use Illuminate\View\Component;

class table extends Component
{
    public $typeclient;
    public $route;
    public $infosPage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($typesclient, $route, $infostable, $infosPage)
    {
        $this->typesclient = $typesclient;
        $this->route = $route;
        $this->infostable = $infostable;
        $this->infosPage = $infosPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gestion.table',[
            'typesclient' => $this->typesclient,
            'route' => $this->route,
            'infostable' => $this->infostable,
            'infosPage' => $this->infosPage
        ]);
    }
}
