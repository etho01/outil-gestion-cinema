<?php

namespace App\utils\class;

use App\Models\cinema\Cinema;

class InformationPage {
    private $request;
    private $cinema;
    public $page;

    function __construct ($page ,$request, $cinema){
        $this->request = $request;
        $this->cinema = $cinema;
        $this->page = $page;
        if ($this->isGlobalPage()){
            $this->instanceCinema = null;
        } else {
            $this->instanceCinema = Cinema::getCinemaSlug($this->cinema);
        }
    }


    public function getRoute($nameRoute, $paramSup = array()){
        return route($nameRoute, ['cinema' => $this->cinema] + $paramSup);
    }

    public function getinfosRoute(){
        return ['cinema' => $this->cinema];
    }

    public function isGlobalPage(){
        return $this->cinema == null;
    }

    public function instanceCinema(){
        return $this->instanceCinema;
    }

    public function getSlugCinema(){
        return $this->cinema;
    }

    public function getIdcinema(){
        return $this->instanceCinema->id;
    }
}