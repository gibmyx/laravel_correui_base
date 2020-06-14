<?php

//RUTAS PARA PETICIONES HTTP
Route::post('/articulos/ajax_guardar', [
    'uses' => 'Articulos\Controllers\ArticulosController@ajax_guardar'
]);
Route::get('/articulos/ajax_listar_articulos', [
    'uses' => 'Articulos\Controllers\ArticulosController@ajax_listar_articulos'
]);
Route::post('/articulos/ajax_update_state', [
    'uses' => 'Articulos\Controllers\ArticulosController@ajax_update_state'
]);
Route::post('/articulos/ajax_get_catalogos', [
    'uses' => 'Articulos\Controllers\ArticulosController@ajax_get_catalogos'
]);
