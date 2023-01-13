<?php

namespace App\View\Components\gestion;

use Illuminate\View\Component;

class filtre extends Component
{
    public $filtre;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($filtre)
    {
        $this->filtre = $filtre;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gestion.filtre',[
            'filtres' => $this->filtre
        ]);
    }
}
