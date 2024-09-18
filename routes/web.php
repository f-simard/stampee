<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'TestController@index');

Route::get('/membre/creer', 'MembreController@creer');
Route::post('/membre/creer', 'MembreController@sauvegarder');
Route::get('/membre/voir', 'MembreController@voir');
Route::get('/membre/timbre', 'TimbreController@afficherSelonMembre');
Route::get('/membre/enchere', 'EnchereController@afficherSelonMembre');

Route::get('/timbre/creer', 'TimbreController@creer');
Route::post('/timbre/creer', 'TimbreController@sauvegarder');
Route::get('/timbre/voir', 'TimbreController@afficherUn');

Route::get('/enchere/creer', 'EnchereController@creer');
Route::post('/enchere/creer', 'EnchereController@sauvegarder');
Route::get('/enchere/catalogue', 'EnchereController@afficherTous');
Route::get('/enchere/voir', 'EnchereController@afficherUn');
Route::post('/enchere/supprimer', 'EnchereController@supprimer');

Route::get('/connexion', 'AuthController@index');
Route::post('/connexion', 'AuthController@sauvegarder');
Route::get('/deconnexion', 'AuthController@supprimer');
Route::get('/accesRefuse', 'AuthController@accesRefuse');

Route::get('/enConstruction', 'TestController@enConstruction');

Route::dispatch();