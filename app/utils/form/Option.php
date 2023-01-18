<?php

namespace App\utils\form;

class Option{

    public $id;
    public $nom;

    function __construct ($id ,$nom){
        $this->id = (int) $id;
        $this->nom = $nom;
    }

    public static function getOptionOuiNon(){
        return collect([1 => new Option(1, 'NON'), 2 => new Option(2, 'OUI')]);
    }

}