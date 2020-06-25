<?php
Auth::routes();
Route::get('',                      'SinglePageController@home');
Route::get('logout',                'SinglePageController@cerrarSession');
Route::get('dashboard',             'SinglePageController@home');
Route::get('encuesta/{any}',        'SinglePageController@index')->where('any', '.*');
Route::get('encuestas/show/{name}', 'TblEncuestasController@search');
Route::post('encuestas/save',       'TblEncuestasController@save');
Route::post('preguntassave',        'TblEncuestasController@preguntasSave');
Route::get('preguntas',            'TblEncuestasController@indexPreguntas');

Route::get('puntoatencion', 'SinglePageController@punto');
Route::group(['middleware' => ['auth','role:admin']],function()
{
    Route::get('limpiar','SinglePageController@limpiar');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
Route::group(['middleware' => ['auth','validateActive']],function()
{
    #region OTHERS FUNCTIONS
    Route::get('dashboard/{any}', 'SinglePageController@index')->where('any', '.*');
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
    
    
    Route::resource('encuestas', 'TblEncuestasController');


});
