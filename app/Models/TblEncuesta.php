<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuesta
 * 
 * @property int $id
 * @property string $nombre
 * @property string $titulo
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_fin
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|TblEncuestasPregunta[] $tbl_encuestas_preguntas
 * @property Collection|TblEncuestasResultado[] $tbl_encuestas_resultados
 *
 * @package App\Models
 */
class TblEncuesta extends Model
{
	protected $table = 'tbl_encuestas';

	protected $dates = [
		'fecha_inicio',
		'fecha_fin'
	];

	protected $fillable = [
		'nombre',
		'titulo',
		'fecha_inicio',
		'fecha_fin'
	];

	public function tbl_encuestas_preguntas()
	{
		return $this->hasMany(TblEncuestasPregunta::class, 'id_tbl_encuestas');
	}

	public function tbl_encuestas_resultados()
	{
		return $this->hasMany(TblEncuestasResultado::class, 'id_tbl_encuestas');
	}
}
