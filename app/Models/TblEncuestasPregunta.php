<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuestasPregunta
 * 
 * @property int $id
 * @property int $id_tbl_encuestas
 * @property int $id_tbl_encuestas_respuestas_tipos
 * @property string $pregunta
 * @property string $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TblEncuesta $tbl_encuesta
 * @property Collection|TblEncuestasRespuesta[] $tbl_encuestas_respuestas
 * @property Collection|TblEncuestasResultadosRespuesta[] $tbl_encuestas_resultados_respuestas
 *
 * @package App\Models
 */
class TblEncuestasPregunta extends Model
{
	protected $table = 'tbl_encuestas_preguntas';

	protected $casts = [
		'id_tbl_encuestas' => 'int',
		'id_tbl_encuestas_respuestas_tipos' => 'int'
	];

	protected $fillable = [
		'id_tbl_encuestas',
		'id_tbl_encuestas_respuestas_tipos',
		'pregunta',
		'order'
	];

	public function tbl_encuesta()
	{
		return $this->belongsTo(TblEncuesta::class, 'id_tbl_encuestas');
	}

	public function tbl_encuestas_respuestas()
	{
		return $this->hasMany(TblEncuestasRespuesta::class, 'id_tbl_encuestas_preguntas');
	}

	public function tbl_encuestas_resultados_respuestas()
	{
		return $this->hasMany(TblEncuestasResultadosRespuesta::class, 'id_tbl_encuestas_preguntas');
	}
}
