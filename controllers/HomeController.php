<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;

class HomeController
{
	public function index(){
		return View::render('pages/accueil');
	}

}