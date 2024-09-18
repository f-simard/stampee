<?php

namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class MiseController
{

	public function creer($data = [])
	{
		Auth::session();
		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$infoEnchere = $enchere->selectByField($idEnchere, 'idEnchere');

		$mise = new Mise();
		$miseMax = $mise->miseMax($idEnchere, 'idEnchere');
		$miseCompte = $mise->compte($idEnchere, 'idEnchere');

		return View::render('mise/creer', ['enchere' => $infoEnchere, 'miseMax' => $miseMax, 'miseCompte' => $miseCompte]);
	}

	public function sauvegarder($data = [])
	{
		Auth::session();

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$infoEnchere = $enchere->selectByField($idEnchere, 'idEnchere');

		$mise = new Mise();
		$miseMax = $mise->miseMax($idEnchere, 'idEnchere')['montant'];
		$min = $miseMax;

		if (!$miseMax ){
			$min = $infoEnchere['prixPlancher'];
		}

		$validateur = new Validator();

		$validateur->champ('montant', $data['montant'], "Mise")->requis()->plusGrand($min);

		//ajuster data
		$data['idMembre'] = $_SESSION['idMembre'];

		if ($validateur->estSucces()) {

			//créer mise
			$mise = new Mise();
			$miseAJoute = $mise->insert($data);

			return View::redirect('enchere/voir?idEnchere=' . $idEnchere);
		} else {

			$erreurs = $validateur->obtenirErreur();

			$enchere = new Enchere();
			$infoEnchere = $enchere->selectByField($idEnchere, 'idEnchere');

			$mise = new Mise();
			$miseMax = $mise->miseMax($idEnchere, 'idEnchere');
			$miseCompte = $mise->compte($idEnchere, 'idEnchere');


			return View::render('mise/creer', [
				'erreurs' => $erreurs,
				'enchere' => $infoEnchere,
				'miseMax' => $miseMax,
				'miseCompte' => $miseCompte
			]);
		}
	}
}
