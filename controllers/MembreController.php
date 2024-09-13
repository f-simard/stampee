<?php

namespace App\Controllers;

use App\Providers\View;

class MembreController
{

	public function creer()
	{
		return View::render('membre/creer');
	}

	public function sauvegarder()
	{
		return View::render('erreur', ['msg' => "testController index"]);
	}
}
