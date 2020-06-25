<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblPregunta
 * 
 * @property int $id
 * @property string $dirección
 * @property string $email
 * @property string $nombre
 * @property string $pregunta
 * @property string $telefono
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class TblPregunta extends Model
{
	protected $table = 'tbl_preguntas';

	protected $fillable = [
		'dirección',
		'email',
		'nombre',
		'pregunta',
		'telefono'
	];
}
