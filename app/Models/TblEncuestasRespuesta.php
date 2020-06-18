<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuestasRespuesta
 * 
 * @property int $id
 * @property int $id_tbl_encuestas_preguntas
 * @property string $respuestas
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TblEncuestasPregunta $tbl_encuestas_pregunta
 * @property Collection|TblEncuestasResultadosRespuesta[] $tbl_encuestas_resultados_respuestas
 *
 * @package App\Models
 */
class TblEncuestasRespuesta extends Model
{
	protected $table = 'tbl_encuestas_respuestas';

	protected $casts = [
		'id_tbl_encuestas_preguntas' => 'int'
	];

	protected $fillable = [
		'id_tbl_encuestas_preguntas',
		'respuestas'
	];

	public function tbl_encuestas_pregunta()
	{
		return $this->belongsTo(TblEncuestasPregunta::class, 'id_tbl_encuestas_preguntas');
	}

	public function tbl_encuestas_resultados_respuestas()
	{
		return $this->hasMany(TblEncuestasResultadosRespuesta::class, 'id_tbl_encuestas_respuestas');
	}
}
