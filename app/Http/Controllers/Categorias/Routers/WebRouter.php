<?php

//RUTAS PARA PETICIONES HTTP
Route::post('/categorias/ajax_guardar', [
    'uses' => 'Categorias\Controllers\CategoriasController@ajax_guardar'
]);
Route::post('/categorias/ajax_listar_categoria', [
    'uses' => 'Categorias\Controllers\CategoriasController@ajax_listar_categoria'
]);
Route::post('/categorias/ajax_update_state', [
    'uses' => 'Categorias\Controllers\CategoriasController@ajax_update_state'
]);
