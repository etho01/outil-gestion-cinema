<?php

namespace App\utils\form;

class OptionForm{

    public $id;
    public $nom;

    function __construct ($id ,$nom){
        $this->id = (int) $id;
        $this->nom = $nom;
    }

    public static function getOptionOuiNon(){
        return collect([1 => new OptionForm(1, 'NON'), 2 => new OptionForm(2, 'OUI')]);
    }

}