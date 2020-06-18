<?php
Auth::routes();
Route::get('','SinglePageController@home');
Route::get('dashboard','SinglePageController@home');
Route::get('logout','SinglePageController@cerrarSession');
Route::get('puntoatencion',    'dataControllers@puntosAtencion');
Route::get('test',    'dataControllers@test');

Route::group(['middleware' => ['auth','role:admin']],function()
{
    Route::get('limpiar','SinglePageController@limpiar');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
Route::group(['middleware' => ['auth','validateActive']],function()
{
    #region OTHERS FUNCTIONS
    Route::get('dashboard/{any}', 'SinglePageController@index')->where('any', '.*');
    Route::get('documentotipo',    'dataControllers@documentosTipo');
    Route::get('eps',    'dataControllers@EPS');
    Route::get('motivoconsulta',    'dataControllers@motivoConsulta');
    Route::get('modalidadatencion',    'dataControllers@modalidadAtencion');
    Route::get('tosopciones',    'dataControllers@tosOpciones');
    Route::get('fiebreopciones',    'dataControllers@fiebreOpciones');
    Route::get('medicamentos',    'dataControllers@medicamentos');
    #endregion OTHERS FUNCTIONS
    
    Route::prefix('usuarios')->group(function () {
        Route::get('selected',      'UsuariosController@usuarioActual');
        Route::get('',              'UsuariosController@index');
        Route::get('roles',         'UsuariosController@rolesAll');
        Route::post('delete',       'UsuariosController@borrar');
        Route::get('edit/{id}',     'UsuariosController@usuariosFind');
        Route::post('editSave/{id}','UsuariosController@editSave');
        Route::post('newsave',      'UsuariosController@newsave');
        Route::get('permistions',   'AuthController@permistions');
        Route::post('permistions/all','AuthController@permistionsActuales');
        Route::post('permistions/save','AuthController@permistionsSave');
        Route::post('changepass',      'AuthController@changepass');
    });
    Route::prefix('paciente')->group(function () {
        Route::post('search',     'PacientesController@search');
    });
    Route::resource('encuestas','TblEncuestaPacienteController');
});
