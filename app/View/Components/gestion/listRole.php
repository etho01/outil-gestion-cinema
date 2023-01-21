<?php

namespace App\View\Components\gestion;

use App\Models\User;
use App\Models\user\Role;
use Illuminate\View\Component;

class listRole extends Component
{
    public $idClient;
    public $idUser;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idClient, $idUser)
    {
        $this->idUser = $idUser;
        $this->idClient = $idClient;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gestion.list-role', [
            'roles' => Role::where('client_id', $this->idClient)->get(),
            'listRoleEnable' => User::find($this->idClient)->roles()->get()->pluck('id')->all(),
        ]);
    }
}
