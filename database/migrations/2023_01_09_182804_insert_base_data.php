<?php

use App\Models\user\Role;
use App\Models\User;
use App\Models\client\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Client::insert([
            'id' => 1,
            'nom' => 'gestionnaire',
            'logo' => 'logo',
            'email'=> 'barbeynicolas.basly@gmail.com'
        ]);
        Role::insert([
            'id' => 1,
            'nom' => 'administrateur',
            'is_admin' => true,
            'client_id' => 1
        ]);
        User::insert([
            'id' => 1,
            'name' => 'test',
            'email' => 'test@test.fr',
            'password' => Hash::make('testtest'),
            'role_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::find(1)->delete();
        Role::find(1)->delete();
        Client::find(1)->delete();
    }
};
