<?php

use Illuminate\Database\Seeder;

class TblEncuestasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_encuestas')->delete();
        
        \DB::table('tbl_encuestas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'encuesta1',
                'titulo' => 'Encuesta Previa Rendición de Cuentas',
                'fecha_inicio' => NULL,
                'fecha_fin' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}