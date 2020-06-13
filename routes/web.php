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
    return redirect('/login');
});

Route::get('/js/cxlt-vue2-toastr.js.map', function () {
    return redirect('/escritorio');
});

Auth::routes();

//RUTA DEL MODULO HERRAMIENTA
require base_path('/app/Http/Controllers/Herramientas/Routers/WebRouter.php');
//RUTA DEL MODULO CATEGORIAS
require base_path('/app/Http/Controllers/Categorias/Routers/WebRouter.php');

Route::get('/{any}', 'HomeController@index')
    ->where('any', '.*');


