<?php

namespace App\Exports;
use App\Models\TblEncuestaPaciente;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class encuestaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $encabezado=array(
            'FECHA',
            'HORA',
            'TEMPERATURA',
            'NOMBRES COMPLETOS',
            'DOCUMENTO',
            'FECHA NACIMIENTO',
            'EDAD',
            'EPS',
            'DIRRECION',
            'BARRIO',
            'TELEFONO',
            'MOTIVO DE CONSULTA',
            'MODALIDAD DE LA ATENCIÓN',
            'QUIEN RECIBIO',
            'OBSERVACION',
            'Ha tenidocontacto con algun sintomatico de coronavirus?',
            'Estuvo en contacto con una persona diagnosticada con covid 19?',
            'tos?',
            'Fiebre?',
            'Fatiga O MALESTAR GENERAL?',
            'Dolor de garganta?',
            //s'Dificultad para respirar?', 
            'Ha tomado medicamentos para la gripe? Cual:',
        );
        $data = TblEncuestaPaciente::
        select(
            DB::raw('date(tbl_encuesta_pacientes.created_at) AS fecha'),
            DB::raw('DATE_FORMAT(tbl_encuesta_pacientes.created_at,"%H:%i:%S %p") AS hora'),
            'tbl_encuesta_pacientes.temperatura',
            DB::raw('CONCAT_WS(" ",tbl_pacientes.nombre_primero,tbl_pacientes.nombre_segundo,tbl_pacientes.apellido_primero,tbl_pacientes.apellido_segundo) as paciente'),
            'tbl_pacientes.documento',
            'tbl_pacientes.fecha_nacimiento',
            DB::raw('TIMESTAMPDIFF(YEAR,tbl_pacientes.fecha_nacimiento,now()) as edad'),
            'tbl_eps.nombre as eps',
            'tbl_pacientes.direccion',
            'tbl_pacientes.barrio',
            'tbl_pacientes.celular1',
            'tbl_motivo_consulta.nombre AS motivo_consulta',
            'tbl_modalidad_atencion.nombre AS modalidad_atencion',
            DB::raw('CONCAT_WS(" ",users.nombre_segundo,users.nombre_primero,users.apellido_primero,users.apellido_segundo) as quien_recibe'),
            'tbl_encuesta_pacientes.observacion',
            'tbl_encuesta_pacientes.si_tuvo_contacto_paciente_covid',
            'tbl_encuesta_pacientes.si_tuvo_contacto_diagnosticado_covid',
            'tbl_tos_opciones.nombre AS Tos',
            'tbl_fiebre_opciones.nombre AS Fiebre',
            DB::raw('CASE WHEN tbl_encuesta_pacientes.fatiga = 1  THEN "SI" ELSE "NO" END as fatiga'),
            DB::raw('case when tbl_encuesta_pacientes.dolor_garganta =1   then "SI" else "NO" end as dolor_garganta'),
            //DB::raw('case when tbl_encuesta_pacientes.malestar_general =1   then "SI" else "NO" end as malestar_general'),
            DB::raw('case when tbl_encuesta_pacientes.tomado_medicamentos_gripa =1   then CONCAT("SI ",COALESCE(GROUP_CONCAT(tbl_medicamentos.nombre),"-")) else "NO" end as tomado_medicamentos_gripa')
        )->
        join('tbl_pacientes','tbl_encuesta_pacientes.paciente_id','=', 'tbl_pacientes.id')-> 
        join('tbl_eps','tbl_pacientes.eps_id','=', 'tbl_eps.id')-> 
        join('tbl_motivo_consulta','tbl_motivo_consulta.id','=', 'tbl_encuesta_pacientes.motivo_consulta_id')-> 
        join('tbl_modalidad_atencion','tbl_encuesta_pacientes.modalidad_atencion_id','=', 'tbl_modalidad_atencion.id')-> 
        join('users','users.id','=', 'tbl_encuesta_pacientes.user_id')-> 
        join('tbl_fiebre_opciones','tbl_fiebre_opciones.id','=', 'tbl_encuesta_pacientes.fiebre_opciones_id')-> 
        join('tbl_tos_opciones','tbl_tos_opciones.id','=', 'tbl_encuesta_pacientes.tos_opciones_id')-> 
        leftJoin('tbl_encuesta_pacientes_medicamentos','tbl_encuesta_pacientes_medicamentos.tbl_encuesta_pacientes_id','=', 'tbl_encuesta_pacientes.id')-> 
        leftJoin('tbl_medicamentos','tbl_medicamentos.id','=', 'tbl_encuesta_pacientes_medicamentos.tbl_medicamentos_id')->
        groupBy('tbl_encuesta_pacientes.id')->
        get();
        $data->prepend($encabezado);
        return $data;
    }
}
