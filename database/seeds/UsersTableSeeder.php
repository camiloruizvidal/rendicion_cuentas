<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    public function run()
    {        
        $user = new User();
        $user->nombre_primero = 'admin';
        $user->nombre_segundo = 'admin';
        $user->apellido_primero = 'admin';
        $user->apellido_segundo = 'admin';
        $user->documento = '1';
        $user->activo = 1;
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->rol='admin';
        $user->created_at = date('Y-m-d h:i:s');
        $user->save();
        unset($user);

     }
}