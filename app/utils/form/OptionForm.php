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

    public static function getOption($array = array()){
        $tab_collect = array();
        foreach ($array as $id_option => $nom_option){
            $tab_collect[$id_option] = new OptionForm($id_option, $nom_option);
        }
        return collect($tab_collect);
    } 

    public static function getoptionClass($collect){
        $tab_collect = array();
        foreach($collect as $element){
            $tab_collect[$element->id] = new OptionForm($element->id, $element->nom);
        }
        return collect($tab_collect);
    }

}