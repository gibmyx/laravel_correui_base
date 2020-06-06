<?php

//RUTAS PARA PETICIONES HTTP
Route::post('/categoria/ajax_guradar', [
    'uses' => 'Herramientas\Controllers\CategoriasController@ajax_guradar'
]);
Route::post('/categoria/ajax_listar_categoria', [
    'uses' => 'Herramientas\Controllers\CategoriasController@ajax_listar_categoria'
]);
