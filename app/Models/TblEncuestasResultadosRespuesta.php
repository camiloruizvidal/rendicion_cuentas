<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuestasResultadosRespuesta
 * 
 * @property int $id
 * @property int $id_tbl_encuestas_resultados
 * @property int $id_tbl_encuestas_preguntas
 * @property string $pregunta
 * @property int $id_tbl_encuestas_respuestas
 * @property string $respuestas
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TblEncuestasPregunta $tbl_encuestas_pregunta
 * @property TblEncuestasRespuesta $tbl_encuestas_respuesta
 *
 * @package App\Models
 */
class TblEncuestasResultadosRespuesta extends Model
{
	protected $table = 'tbl_encuestas_resultados_respuestas';

	protected $casts = [
		'id_tbl_encuestas_resultados' => 'int',
		'id_tbl_encuestas_preguntas' => 'int',
		'id_tbl_encuestas_respuestas' => 'int'
	];

	protected $fillable = [
		'id_tbl_encuestas_resultados',
		'id_tbl_encuestas_preguntas',
		'pregunta',
		'id_tbl_encuestas_respuestas',
		'respuestas'
	];

	public function tbl_encuestas_pregunta()
	{
		return $this->belongsTo(TblEncuestasPregunta::class, 'id_tbl_encuestas_preguntas');
	}

	public function tbl_encuestas_respuesta()
	{
		return $this->belongsTo(TblEncuestasRespuesta::class, 'id_tbl_encuestas_respuestas');
	}
}
