<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria
class TblConfig extends Model
{
    use SoftDeletes; //Implementamos 

    protected $table = 'tbl_config';
    protected $primaryKey = 'id';
    protected $fillable = [
                  'name',
                  'value'
              ];
}
