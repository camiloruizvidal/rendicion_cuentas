<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; //Implementamos 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre_primero','nombre_segundo','apellido_primero','apellido_segundo','documento','activo','email','created_at','updated_at','deleted_at','id_punto_atencion','id_area'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function TblPuntosAtencion()
    {
        return $this->belongsTo('App\Models\TblPuntosAtenciones','id_punto_atencion','id');
    }
    public function Tbl_areas()
    {
        return $this->belongsTo('App\Models\TblArea','id_area','id');
    }
    public function tbl_recursos_humanos()
    {
        return $this->hasOne('App\Models\RecursoHumano', 'user_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
