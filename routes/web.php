<?php
use Illuminate\Support\Facades\Route;



Route::get('/', 'PostControlador@index');
Route::post('/', 'PostControlador@store');
Route::delete('/{id}', 'PostControlador@destroy');
Route::get('/download/{id}', 'PostControlador@download');
