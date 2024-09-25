<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/enConstruction', 'TestController@enConstruction');

Route::get('','HomeController@index');

Route::get('/membre/creer', 'MembreController@creer');
Route::post('/membre/creer', 'MembreController@sauvegarder');
Route::get('/membre/voir', 'MembreController@voir');
Route::get('/membre/timbre', 'TimbreController@afficherSelonMembre');
Route::get('/membre/enchere', 'EnchereController@afficherSelonMembre');
Route::get('/membre/favori', 'FavoriController@afficherSelonMembre');
Route::get('/membre/mise', 'MiseController@afficherSelonMembre');

Route::get('/timbre/creer', 'TimbreController@creer');
Route::post('/timbre/creer', 'TimbreController@sauvegarder');
Route::get('/timbre/voir', 'TimbreController@afficherUn');

Route::get('/enchere/creer', 'EnchereController@creer');
Route::post('/enchere/creer', 'EnchereController@sauvegarder');
Route::get('/enchere/catalogue', 'EnchereController@afficherTous');
Route::get('/enchere/activeFiltre', 'EnchereController@recupererActiveFiltre');
Route::get('/enchere/archive', 'EnchereController@afficherArchive');
Route::get('/enchere/archiveFiltre', 'EnchereController@recupererArchiveFiltre');
Route::get('/enchere/voir', 'EnchereController@afficherUn');
Route::post('/enchere/supprimer', 'EnchereController@supprimer');
Route::post('/enchere/lord', 'EnchereController@lord');

Route::get('/mise/creer', 'MiseController@creer');
Route::post('/mise/creer', 'MiseController@sauvegarder');

Route::post('/favori/creer', 'FavoriController@creer');
Route::post('/favori/supprimer', 'FavoriController@supprimer');

Route::get('/connexion', 'AuthController@index');
Route::post('/connexion', 'AuthController@sauvegarder');
Route::get('/deconnexion', 'AuthController@supprimer');
Route::get('/accesRefuse', 'AuthController@accesRefuse');
Route::get('/Auth/estAdmin', 'AuthController@estAdmin');


Route::dispatch();