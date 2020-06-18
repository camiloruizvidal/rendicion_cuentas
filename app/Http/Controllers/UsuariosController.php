<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Models\RecursoHumano;
use App\Models\TblPuntosAtencion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use DB;
use Session;

class UsuariosController extends Controller
{
    public function rolesAll()
    {
        return Role::get();
    }
    public function usuarioActual()
    {
        $data = User::where('id','=',Auth::user()->id)->with('roles')->get()->first();
        $data->tbl_punto_atencion=TblPuntosAtencion::find(Session::get('id_punto_atencion'));
        return $data;
    }
    public function index()
    {
        $data = User::where('id','!=',Auth::user()->id)->with('roles')->get();
        return $this->sendResponse($data);
    }
    public function viewEdit($id)
    {
        return User::findOrFail($id);
    }
    private function newRecursoHumando($request)
    {
        $RecursoHumano = new RecursoHumano();
        $RecursoHumano->nombre_primero   = $request->nombre_primero;
        $RecursoHumano->nombre_segundo   = $request->nombre_segundo;
        $RecursoHumano->apellido_primero = $request->apellido_primero;
        $RecursoHumano->apellido_segundo = $request->apellido_segundo;
        $RecursoHumano->documento        = $request->documento;
        $RecursoHumano->direccion        = $request->direccion;
        $RecursoHumano->documento_tipo_id= $request->documento_tipo_id;
        $RecursoHumano->celular          = $request->celular;
        $RecursoHumano->activo           = $request->activo?1:0;
        $RecursoHumano->email            = $request->email;
        $RecursoHumano->cargo_id         = $request->cargo_id;
        $RecursoHumano->save();
    }
    public function newsave(Request $request)
    {
        try {
            $roles = Role::where('id', $request->rol)->first();
            $user                    = new User();
            
            $user->nombre_primero    = $request->nombre_primero;
            $user->nombre_segundo    = $request->nombre_segundo;
            $user->apellido_primero  = $request->apellido_primero;
            $user->apellido_segundo  = $request->apellido_segundo;
            $user->documento         = $request->documento;
            $user->activo            = $request->activo?1:0;
            $user->email             = $request->email;
            $user->direccion         = $request->direccion;
            $user->celular           = $request->celular;
            $user->password          = bcrypt($request->documento);
            $user->save();
            $user->roles()->attach($roles);
            if($request->cargo_id==2)
            {
                $this->newRecursoHumando($request);
            }
            return $this->sendResponse($user);
        }
        catch (\Throwable $th)
        {
            Log::error(json_encode(['user'=>Auth::user(),'date'=>date('Y-m-d h:i A'),'msj'=>$th->getMessage()]));
            return response()->json(['validate'=>false,'data'=>$th->getMessage()],422);
        }
    }
    public function update(Request $request)
    {
        try
        {
            $user                    = User::findOrFail($request->id);
            $user->nombre_primero    = $request->nombre_primero;
            $user->nombre_segundo    = $request->nombre_segundo;
            $user->apellido_primero  = $request->apellido_primero;
            $user->documento         = $request->documento;
            $user->activo            = $request->activo;
            $user->email             = $request->email;
            $user->save();
            return ['validate'=>true,'data'=>$user];
        } catch (\Throwable $th) {
            Log::error(json_encode(['user'=>Auth::user(),'date'=>date('Y-m-d h:i A'),'msj'=>$th->getMessage()]));
            return ['validate'=>false,'data'=>$th->getMessage()];
        }
    }
    public function bloquear(Request $request)
    {
        try {
            $user                    = User::findOrFail($request->id);
            $user->activo            = $request->estado;
            $user->save();
            return ['validate'=>true,'data'=>$user];
        } catch (\Throwable $th) {
            Log::error(json_encode(['user'=>Auth::user(),'date'=>date('Y-m-d h:i A'),'msj'=>$th->getMessage()]));
            return ['validate'=>false,'data'=>$th->getMessage()];
        }
    }
    public function restablecer(Request $request)
    {
        try {
            $user           = User::findOrFail($request->id);
            $user->password = bcrypt($user->documento);
            $user->save();
            return ['validate'=>true,'data'=>$user];
        }
        catch (\Throwable $th) {
            Log::error(json_encode(['user'=>Auth::user(),'date'=>date('Y-m-d h:i A'),'msj'=>$th->getMessage()]));
            return ['validate'=>false,'data'=>$th->getMessage()];
        }

    }
    public function editSave($id,Request $request)
    {
        try
        {
            $user = User::findOrFail($id);
            $user->nombre_primero    = $request->nombre_primero;
            $user->nombre_segundo    = $request->nombre_segundo;
            $user->apellido_primero  = $request->apellido_primero;
            $user->apellido_segundo  = $request->apellido_segundo;
            $user->email             = $request->email;
            $user->documento         = $request->documento;
            $user->activo            = $request->activo;
            $user->save();
            DB::table('role_user')
            ->where('user_id', $id)
            ->update(['role_id' => $request->rol]);
            return ['validate'=>true,'data'=>$user,'msj'=>null];    
        }
        catch (\Throwable $th)
        {
            return ['validate'=>false,'data'=>[],'msj'=>$th->getMessage()];
        }
    }
    public function changePass(Request $request)
    {
        if($request->pass1===$request->pass2)
        {
            if($request->email===Auth::user()->email)
            {
                if(Hash::check($request->passold, Auth::user()->password))
                {
                    $user = User::findOrFail(Auth::user()->id);
                    $user->password=bcrypt($request->pass1);
                    $user->save();
                    return ['validate'=>true,'msj'=>'La contraseña fue modificada con éxito'];
                }
                else
                {
                    return ['validate'=>false,'msj'=>'La contraseña anterior no coincide con la contraseña registrada'];
                }
            }
            else
            {
                return ['validate'=>false,'msj'=>'El usuario actual no coincide con el que desea cambiar la contraseña.'];
            }
        }
        else{
            return ['validate'=>false,'msj'=>'Las nuevas contraseñas no coinciden'];
        }
    }
    public function usuariosFind($id)
    {
        try 
        {
            $data = User::where('id','=',$id)->with('roles')->get()->first();
            return response()->json(
                ['validate'=>true,'data'=>$data,'msj'=>null]
                , 200);
        }
        catch (\Throwable $th)
        {
            return response()->json(
                ['validate'=>false,'data'=>[],'msj'=>$th->getMessage()]
                , 500);
        }
    }
    public function usuariosAll(Request $request)
    {
        try 
        {
            $data=User::with('TblPuntosAtencion')
            ->orderBy('id_punto_atencion')
            ->orderBy('apellido_primero')
            ->orderBy('apellido_segundo')
            ->orderBy('nombre_primero')
            ->orderBy('nombre_segundo')
            ->where('id','!=',Auth::user()->id)
            ->where('id','!=','1')
            ->get();
            return response()->json(['validate' => true,'data'=>$data,'msj'=>null], 200);
        }
        catch (\Throwable $th) 
        {
            return response()->json(['validate' => false,'data'=>null,'msj'=>$th->getMessage()], 500);
        }
    }
    public function actual()
    {
        try
        {
            $user = Auth::user();
            unset($user->email_verified_at);
            unset($user->password);
            unset($user->remember_token);
            unset($user->created_at);
            unset($user->updated_at);
            return ['validate'=>true,'data'=>$user,'msj'=>''];
        }
        catch (\Throwable $th) 
        {
            return ['validate'=>false,'data'=>null,'msj'=>$th->getMessage()];        
        }
    }
    public function borrar(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);
            $data->delete();
            return ['validate'=>true,'msj'=>null,'response'=>'Registro borrado'];
        } catch (\Throwable $th) {
            return ['validate'=>false,'msj'=>$th->getMessage(),'response'=>null];
        }
    }
}
