<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Artisan;

class SinglePageController extends Controller
{
    public function Limpiar()
    {
        Artisan::call('optimize:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return response()->json(['validate'=>true,'msj'=>'clear success']);
    }
    public function cerrarSession()
    {
        Auth::logout();
        return Redirect::to('/')->with('msg', 'Gracias por visitarnos!.');
    }
    public function home()
    {
        return redirect('/dashboard/start');
    }
    public function index(Request $request) 
    {
        return view('layouts.app');
    }
}
