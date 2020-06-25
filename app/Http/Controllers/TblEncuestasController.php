<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblEncuesta;
use App\Models\TblEncuestasResultado;
use App\Models\TblEncuestasResultadosRespuesta;
use App\Models\TblPregunta;


class TblEncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function search($name)
    {
        $data = TblEncuesta::
        with('tbl_encuestas_preguntas.tbl_encuestas_respuestas')->
        where('nombre','=',$name)->
        firstOrFail();   
        return $this->sendResponse($data);
    }
    public function save(Request $request)
    {
        $res = new TblEncuestasResultado();
        $res->id_tbl_encuestas=$request->encuesta_id;
        $res->save();
        foreach($request->respuestas as $temp)
        {
            $temp = (object) $temp;
            $resp = new TblEncuestasResultadosRespuesta();
            $resp->id_tbl_encuestas_resultados  = $res->id;
            $resp->id_tbl_encuestas_preguntas   = $temp->id_pregunta;
            $resp->id_tbl_encuestas_respuestas  = $temp->respuesta;
            $resp->save();
        }
        return $this->sendResponse($res);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function preguntasSave(Request $request)
    {
        $preguntas = new TblPregunta();
        $preguntas->dirección = $request->dirección;
        $preguntas->email = $request->email;
        $preguntas->nombre = $request->nombre;
        $preguntas->pregunta = $request->pregunta;
        $preguntas->telefono = $request->telefono;
        $preguntas->save();
        return  $this->sendResponse('success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
