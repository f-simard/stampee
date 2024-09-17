<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;

use App\Models\Enchere;
use App\Models\Timbre;
use App\Models\Enchere_has_Timbre;

class EnchereController
{

	public function creer()
	{
		$timbre = new Timbre();
		$timbres = $timbre->selectionnerTimbresDispo($_SESSION['idMembre']);

		return View::render('enchere/creer', ['timbres' => $timbres]);
	}

	public function sauvegarder($data = [])
	{

		/*TODO: ameliorer avec boucle pour $_FILES*/
		$validateur = new Validator();

		$validateur->champ('dateDebut', $data['dateDebut'], "date de début")->requis()->formatDate();
		$validateur->champ('dateFin', $data['dateFin'], "date de fin")->requis()->formatDate();
		$validateur->champ('prixPlancher', $data['prixPlancher'], "mise minimum")->requis()->toutNumeric()->plusGrand(0);
		$validateur->champ('estimation', $data['estimation'])->toutNumeric()->plusGrand(0);
		if (!isset($data['timbres'])) {
			$validateur->champ('timbre', null, "timbre")->auMoinsUn();
		}

		//ajouter et manipuler data
		$data['idDevise'] = $_SESSION['idDevise'];


		if ($validateur->estSucces()) {

			//créer utilisateur
			$enchere = new Enchere();

			//créer enchere
			$enchereAjoute = $enchere->insert($data);

			if ($enchereAjoute) {
				$enchere_has_timbre = new Enchere_has_Timbre();
				$ajouterRelation = $enchere_has_timbre->ajouterPlusieurs($data['timbres'], $enchereAjoute);
			}

			return View::redirect('enchere/voir?idEnchere=' . $enchereAjoute);
		} else {

			$erreurs = $validateur->obtenirErreur();

			$timbre = new Timbre();
			$timbres = $timbre->selectionnerTimbresDispo($_SESSION['idMembre']);

			return View::render('enchere/creer', ['erreurs' => $erreurs, 'enchere'=>$data, 'timbres' => $timbres]);
		}
	}

	public function afficherSelonMembre()
	{
		$enchere = new Enchere();
		$encheres = $enchere->selectionnerSelonMembre($_SESSION['idMembre']);

		return View::render('enchere/parMembre', ['encheres' => $encheres]);
	}

	public function afficherTous(){

	}

	public function afficherUn(){

	}
}
