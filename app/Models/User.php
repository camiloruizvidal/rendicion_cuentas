<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * 
 * @property int $id
 * @property string $nombre_primero
 * @property string $nombre_segundo
 * @property string $apellido_primero
 * @property string $apellido_segundo
 * @property string $documento
 * @property string $direccion
 * @property string $celular
 * @property int $activo
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $rol
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property int $id_usuario_deleted_att
 *
 * @package App\Models
 */
class User extends Model
{
	use SoftDeletes;
	protected $table = 'users';

	protected $casts = [
		'activo' => 'int',
		'id_usuario_deleted_att' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nombre_primero',
		'nombre_segundo',
		'apellido_primero',
		'apellido_segundo',
		'documento',
		'direccion',
		'celular',
		'activo',
		'email',
		'email_verified_at',
		'password',
		'rol',
		'remember_token',
		'id_usuario_deleted_att'
	];
}
