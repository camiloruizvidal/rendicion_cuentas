<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TblEncuestasRespuestasTipoSeeder::class);

        $this->call(TblEncuestasTableSeeder::class);
        $this->call(TblEncuestasPreguntasTableSeeder::class);
        $this->call(TblEncuestasRespuestasTableSeeder::class);
    }
}
