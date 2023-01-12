<?php

namespace App\utils\class;

class InformationPage {
    private $request;
    private $cinema;
    private $salle;

    function __construct ($request, $cinema, $salle){
        $this->request = $request;
        $this->cinema = $cinema;
        $this->salle = $salle;
    }

    public function pageIsSet(){
        return $this->salle != null;
    }

    public function getRoute($nameRoute){
        if ($this->pageIsSet()){
            return route('Salle.'.$nameRoute, ['cinema' => $this->cinema, 'salle' => $this->salle]);
        } else {
            return route($nameRoute, ['cinema' => $this->cinema]);
        }
    }

}