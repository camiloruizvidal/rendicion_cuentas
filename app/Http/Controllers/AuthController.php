<?php
namespace App\Http\Controllers;
use DB;
use Hash;
use App\Models\User;
use App\Models\TblPermision;
use Illuminate\Http\Request;
use App\Models\TblPermisionRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller 
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
            'nombre_primero'=>'required|min:3',
            'nombre_segundo'=>'required|min:3',
            'apellido_primero'=>'required|min:3',
            'apellido_segundo'=>'required|min:3',
            'documento'=>'required|min:3',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->nombre_primero       = $request->nombre_primero;
        $user->nombre_segundo       = $request->nombre_segundo;
        $user->apellido_primero     = $request->apellido_primero;
        $user->apellido_segundo     = $request->apellido_segundo;
        $user->documento            = $request->documento;
        $user->email                = $request->email;
        $user->password             = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function changepass(Request $request)
    {
        $user = $user = User::find(Auth::user()->id);
        if($user->email==$request->email && ($request->pass1==$request->pass2) && (Hash::check($request->passold,$user->password)))
        {
            $user->password = bcrypt($request->pass1);
            $user->save();
            return response()->json(['validate' => true,'msj'=>'Cambio realizado con éxito'], 200);
        }
        else{
            return response()->json(['validate' => false], 422);
        }
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials))
        {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function permistions(Request $request)
    {
        try{

            $user = User::where('id','=',Auth::user()->id)->with('roles')->get()->first();
            $permisos      = TblPermision::all();
            $permisosRoles = TblPermisionRoles::where('id_rol','=',$user->roles[0]->id)->get();
            $total         = [];
            foreach($permisos as $key => $temp)
            {
                $key = array_search($temp->id, array_column(json_decode(json_encode($permisosRoles)), 'id_permisions'));
                $total[$temp->nombre]=$key!==FALSE;
            }
            return $total;
        }
        catch(\Exception $e)
        {
            return $this->sendResponse($e->getMessage(),null,422);
        }
    }
    public function permistionsActuales(Request $request)
    {
        try{
            $sql="SELECT   `tbl_permisions`.`id`,
            `tbl_permisions`.`nombre`,
              (SELECT   
              count(*) FROM `tbl_permisions_roles`
              WHERE `tbl_permisions_roles`.`id_permisions` = `tbl_permisions`.`id`
              AND `tbl_permisions_roles`.`id_rol` = ?) as value
            FROM `tbl_permisions`
            ORDER BY `tbl_permisions`.`nombre` DESC";
            $data = DB::select($sql,[$request->id_rol]);
            foreach($data as $key => $temp)
            {
                $data[$key]->value=$temp->value==0?FALSE:TRUE;
            }
            return $data;
        }
        catch(\Exception $e)
        {
            return $this->sendResponse($e->getMessage(),null,422);
        }
    }
    public function permistionsSave(Request $request)
    {
        $id_permiso = TblPermision::where('nombre','=',$request->nombre)->select('id')->first();
        $data       = TblPermisionRoles::where('id_rol','=',$request->id_rol)->where('id_permisions','=',$id_permiso->id)->first();
        if(is_null($data) && $request->status)
        {
            $data                = new TblPermisionRoles();
            $data->id_rol        = $request->id_rol;
            $data->id_permisions = $id_permiso->id;
            $data->Save();
        }
        if(!is_null($data) && (!$request->status))
        {
            $delete = TblPermisionRoles::find($data->id);
            $delete->delete();
        }
        return ['validate'=>true];
    }
    public function permistionsAll(Request $request)
    {
        $permisos      = TblPermision::all();
        $permisosRoles = TblPermisionRoles::where('id_rol','=',$request->id_rol)->get();
        $total         = [];
        foreach($permisos as $key => $temp)
        {
            $key = array_search($temp->id, array_column(json_decode(json_encode($permisosRoles)), 'id_permisions'));
            $total[]=[
                'nombre'=>$temp->nombre, 'value'=> ($key!==FALSE)
            ];
        }
        return $total;
        
    }
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) 
        {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    private function guard()
    {
        return Auth::guard();
    }
}
