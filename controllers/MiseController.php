<?php

namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;
use App\Models\Devise;

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

		$devise = new Devise;
		$devises = $devise->select('nom');

		return View::render('mise/creer', ['enchere' => $infoEnchere, 'miseMax' => $miseMax, 'miseCompte' => $miseCompte, 'devises' => $devises]);
	}

	public function sauvegarder($data = [])
	{
		echo 'miser';
		Auth::session();

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$infoEnchere = $enchere->selectByField($idEnchere, 'idEnchere');

		$mise = new Mise();

		$miseMax = $mise->miseMax($idEnchere, 'idEnchere');
		if ($miseMax) {
			$min = $miseMax['montant'];
		} else {
			$min = $infoEnchere['prixPlancher'];
		}

		if (!$miseMax) {
			$min = $infoEnchere['prixPlancher'];
		}

		$validateur = new Validator();

		$validateur->champ('montant', $data['montant'], "Mise")->requis()->plusGrand($min);

		//ajuster data
		$data['idMembre'] = $_SESSION['idMembre'];
		$data['idDevise'] = $infoEnchere['idDevise'];

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
