<?php

namespace App\utils\class;

use App\utils\class\InformationPage;

class informationPageFormulaire extends InformationPage{
    private $classWork;
    private $slug;
    private $instanceClass;

    function __construct ($page ,$request, $cinema, $salle, $classWork, $slug){
        parent::__construct($page, $request, $cinema, $salle);
        $this->slug = $slug;
        $this->classWork = $classWork;
        if (!$this->isNewElement()){
            $this->instanceClass = $classWork::where('slug', $slug)->first();
        }
    }

    public function isNewElement(){
        return $this->slug == 'new';
    }

    public function getInstanceWork(){
        return $this->instanceClass;
    }

    public function getInfosInstance($nom_var){
        if ($this->isNewElement()){
            return "";
        } else {
            return $this->instanceClass->{$nom_var};
        }
    }

}