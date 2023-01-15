<?php

namespace App\utils\class;

class InformationPage {
    private $request;
    private $cinema;
    private $Page;

    function __construct ($page ,$request, $cinema){
        $this->request = $request;
        $this->cinema = $cinema;
        $this->Page = $page;
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

}