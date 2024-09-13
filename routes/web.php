<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'TestController@index');

Route::get('/membre/creer', 'MembreController@creer');
Route::post('/membre/creer', 'MembreController@sauvegarder');
Route::get('/membre/voir', 'MembreController@voir');

Route::dispatch();