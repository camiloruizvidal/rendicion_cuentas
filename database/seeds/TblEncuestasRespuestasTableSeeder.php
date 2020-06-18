<?php

use Illuminate\Database\Seeder;

class TblEncuestasRespuestasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbl_encuestas_respuestas')->delete();
        
        \DB::table('tbl_encuestas_respuestas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_tbl_encuestas_preguntas' => 1,
                'respuestas' => 'Acciones de Mejoramiento en la Entidad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_tbl_encuestas_preguntas' => 1,
                'respuestas' => 'Cumplimiento de Metas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_tbl_encuestas_preguntas' => 2,
                'respuestas' => 'Presentar un informe Claro  a la comunidad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_tbl_encuestas_preguntas' => 2,
                'respuestas' => 'Motivación a la ciudadanía y a los servidores públicos para la participación activa en la rendición de cuentas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'id_tbl_encuestas_preguntas' => 1,
                'respuestas' => 'Contratación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'id_tbl_encuestas_preguntas' => 1,
                'respuestas' => 'Impacto de la Gestión',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'id_tbl_encuestas_preguntas' => 2,
                'respuestas' => 'Continuar habilitando espacios para la interacción de la ciudadanía basados en el principio de la Transparencia Pública.',
                'created_at' => '2020-06-18 09:48:48',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}