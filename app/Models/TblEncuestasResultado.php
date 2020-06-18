<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuestasResultado
 * 
 * @property int $id
 * @property int $id_tbl_encuestas
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TblEncuesta $tbl_encuesta
 *
 * @package App\Models
 */
class TblEncuestasResultado extends Model
{
	protected $table = 'tbl_encuestas_resultados';

	protected $casts = [
		'id_tbl_encuestas' => 'int'
	];

	protected $fillable = [
		'id_tbl_encuestas'
	];

	public function tbl_encuesta()
	{
		return $this->belongsTo(TblEncuesta::class, 'id_tbl_encuestas');
	}
}
