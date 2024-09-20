<?php

namespace App\Controllers;

use App\Providers\View;

use App\Models\Enchere;
use App\Models\Mise;

class HomeController
{
	public function index()
	{

		$enchere = new Enchere();
		$encheres = $enchere->selectionner4Lord();

		if($encheres){
			foreach ($encheres as &$e) {
				//mise
				$mise = new Mise();
				$miseMax = $mise->miseMax($e['idEnchere'], 'idEnchere');

				if ($miseMax) {
					$e['miseMax'] = $miseMax['montant'];
				}
			}
		}

		return View::render('pages/accueil', ['encheres'=>$encheres]);
	}
}
