<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{any}', 'HomeController@index')
    ->where('any', '.*');

//RUTA DEL MODULO HERRAMIENTA
require base_path('/app/Http/Controllers/Herramientas/Routers/WebRouter.php');

