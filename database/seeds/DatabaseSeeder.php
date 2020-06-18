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
        $this->call(TblConfigSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TblDocumentoTiposTableSeeder::class);
        $this->call(TblPuntoAtencionSeeder::class);
        $this->call(TblModalidadAtencionTableSeeder::class);
        $this->call(TblTosOpcionesTableSeeder::class);
        $this->call(TblFiebreOpcionesTableSeeder::class);
        $this->call(TblMedicamentosTableSeeder::class);
        $this->call(TblEpsTableSeeder::class);
        $this->call(TblMotivoConsultaTableSeeder::class);
    }
}
