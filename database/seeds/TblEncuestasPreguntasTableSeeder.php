<?php

use Illuminate\Database\Seeder;

class TblEncuestasPreguntasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_encuestas_preguntas')->delete();
        
        \DB::table('tbl_encuestas_preguntas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_tbl_encuestas' => 1,
                'id_tbl_encuestas_respuestas_tipos' => 1,
                'pregunta' => '¿En qué tema desea que se haga énfasis en la Audiencia Pública de Rendición de Cuentas?',
                'order' => '1',
                'created_at' => '2020-06-18 09:12:37',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_tbl_encuestas' => 1,
                'id_tbl_encuestas_respuestas_tipos' => 1,
                'pregunta' => '¿Qué recomendaría para la mejora continua del Proceso de Rendición de Cuentas de la Entidad?',
                'order' => '2',
                'created_at' => '2020-06-18 09:12:22',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}