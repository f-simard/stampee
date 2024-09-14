<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'TestController@index');

Route::get('/membre/creer', 'MembreController@creer');
Route::post('/membre/creer', 'MembreController@sauvegarder');
Route::get('/membre/voir', 'MembreController@voir');

Route::get('/timbre/creer', 'TimbreController@creer');
Route::post('/timbre/creer', 'TimbreController@sauvegarder');

Route::get('/connexion', 'AuthController@index');
Route::post('/connexion', 'AuthController@sauvegarder');
Route::get('/deconnexion', 'AuthController@supprimer');
Route::get('/accesRefuse', 'AuthController@accesRefuse');

Route::dispatch();