<?php

namespace App\View\Components\gestion;

use Illuminate\View\Component;

class table extends Component
{
    public $typeclient;
    public $route;
    public $infosPage;
    public $livewireObject;
    public $elementUpdate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($typesclient, $infostable, $route = null, $livewireObject = null, $elementUpdate = null)
    {
        $this->typesclient = $typesclient;
        $this->route = $route;
        $this->infostable = $infostable;
        $this->livewireObject = $livewireObject;
        $this->elementUpdate = $elementUpdate;
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
            'livewireObject' => $this->livewireObject,
            'elementUpdate' => $this->elementUpdate
        ]);
    }
}
