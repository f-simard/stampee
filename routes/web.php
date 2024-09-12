<?php
use App\Controllers;
use App\Routes\Route;

Route::get('', 'TestController@index');

Route::dispatch();