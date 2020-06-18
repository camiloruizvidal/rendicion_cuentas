<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = Role::where('name', 'usuario')->first();
        $role_admin = Role::where('name', 'admin')->first();
        
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
        $user->roles()->attach($role_admin);
        
        unset($user);

     }
}