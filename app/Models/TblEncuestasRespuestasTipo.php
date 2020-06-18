<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblEncuestasRespuestasTipo
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class TblEncuestasRespuestasTipo extends Model
{
	protected $table = 'tbl_encuestas_respuestas_tipos';

	protected $fillable = [
		'nombre'
	];
}
