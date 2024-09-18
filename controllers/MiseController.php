<?php

namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;

use App\Providers\View;
use App\Providers\Validator;

class MiseController
{

	public function creer($data = [])
	{

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$infoEnchere = $enchere->selectByField($idEnchere, 'idEnchere');

		$mise = [];

		return View::render('mise/creer', ['enchere' => $infoEnchere, 'mise' => $mise]);
	}
}
