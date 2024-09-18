<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

use App\Models\Enchere;
use App\Models\Timbre;
use App\Models\Enchere_has_Timbre;
use App\Models\Image;

class EnchereController
{

	public function creer()
	{
		Auth::session();

		$timbre = new Timbre();
		$timbres = $timbre->selectionnerTimbresDispo($_SESSION['idMembre']);

		return View::render('enchere/creer', ['timbres' => $timbres]);
	}

	public function sauvegarder($data = [])
	{

		Auth::session();

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

			return View::render('enchere/creer', ['erreurs' => $erreurs, 'enchere' => $data, 'timbres' => $timbres]);
		}
	}

	public function afficherSelonMembre($data=[])
	{

		Auth::session();

		$msg = View::msg($data);

		$enchere = new Enchere();
		$encheres = $enchere->selectionnerSelonMembre($_SESSION['idMembre']);

		return View::render('enchere/parMembre', ['succes' => $msg, 'encheres' => $encheres]);
	}

	public function afficherTous()
	{
		$enchere = new Enchere();
		$encheres = $enchere->selectionnerCatalogue();

		return View::render('enchere/catalogue', ['encheres'=> $encheres] );
	}

	public function afficherUn($data = []) {

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$enchere = $enchere->selectByField($idEnchere, 'idEnchere');

		$enchere_has_timbre = new Enchere_has_Timbre();
		$nbTimbre = $enchere_has_timbre->compte($idEnchere, 'idEnchere');
		$timbres = $enchere_has_timbre->selectionnerDetails($idEnchere, 'idEnchere');

		foreach ($timbres as &$timbre) {
			$image = new Image();
			$images = $image->imagePrincipale($timbre['idTimbre']);
			$timbre['imageSrc'] = $images['chemin'];

			$imgs = $image->selectMultipleByField($timbre['idTimbre'],'idTimbre');

			foreach ($imgs as $img) {
				$toutesImages[] = $img['chemin'];
			}
		}

		// echo "<pre>";
		// print_r($toutesImages);
		// echo "</pre>";
		// die();

		return View::render('enchere/voir', ['enchere'=>$enchere, 'nbTimbre' => $nbTimbre, 'timbres'=> $timbres, 'images'=>$toutesImages] );
	}

	public function supprimer($data = []){
		Auth::session();

		if (isset($data['idEnchere']) && $data['idEnchere'] != null) {

			$idEnchere = $data['idEnchere'];

			$enchere_has_timbre = new Enchere_has_Timbre();
			$supprET = $enchere_has_timbre->delete($idEnchere, 'idEnchere');

			$enchere = new enchere();
			$supprEnchere = $enchere->delete($idEnchere);


			if ($supprEnchere && $supprET) {
				return View::redirect('membre/enchere?succesSuppr');
			} else {
				return View::render('erreur');
			}
		} else {
			return View::render('erreur', ['msg' => 'Entrée inexistante']);
		}
	}

}
