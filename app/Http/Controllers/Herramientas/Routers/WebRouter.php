<?php

//RUTAS PARA PETICIONES HTTP
Route::post('/herramientas/prueba_peticion', [
    'uses' => 'Herramientas\Controllers\HerramientasController@prueba_peticion'
]);
