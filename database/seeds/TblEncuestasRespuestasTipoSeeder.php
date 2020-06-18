<?php

use Illuminate\Database\Seeder;

class TblEncuestasRespuestasTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_encuestas_respuestas_tipos')->delete();
        
        \DB::table('tbl_encuestas_respuestas_tipos')->insert(array (
            0 => 
            array (
                'nombre' => 'seleccion multiple',
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ),
        ));
    }
}
