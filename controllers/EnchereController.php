<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

use App\Models\Enchere;
use App\Models\Timbre;
use App\Models\Enchere_has_Timbre;
use App\Models\Image;
use App\Models\Mise;
use App\Models\Favori;

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

		$validateur->champ('dateDebut', $data['dateDebut'], "date de début")->requis()->formatDate()->future();
		$validateur->champ('dateFin', $data['dateFin'], "date de fin")->requis()->formatDate()->future()->avantDebut($data['dateDebut']);
		$validateur->champ('prixPlancher', $data['prixPlancher'], "mise minimum")->requis()->toutNumeric()->plusGrand(0);
		$validateur->champ('estimation', $data['estimation'])->toutNumeric()->plusGrand(0);
		if (!isset($data['timbres'])) {
			$validateur->champ('timbre', null, "timbre")->auMoinsUn();
		}

		//ajouter et manipuler data
		$data['idDevise'] = $_SESSION['idDevise'];

		if (isset($data['lord'])) {
			$data['lord'] = 1;
		} else {
			$data['lord'] = 0;
		}

		if ($validateur->estSucces()) {

			try {
				//créer enchere
				$enchere = new Enchere();
				$enchereAjoute = $enchere->insert($data);

				if ($enchereAjoute) {
					$enchere_has_timbre = new Enchere_has_Timbre();
					$ajouterRelation = $enchere_has_timbre->ajouterPlusieurs($data['timbres'], $enchereAjoute);
				}

				return View::redirect('enchere/voir?idEnchere=' . $enchereAjoute);
			} catch (\Exception $e) {
				return View::render('erreur', ['msg' => $e->getMessage()]);
			}
		} else {

			$erreurs = $validateur->obtenirErreur();

			$timbre = new Timbre();
			$timbres = $timbre->selectionnerTimbresDispo($_SESSION['idMembre']);

			return View::render('enchere/creer', ['erreurs' => $erreurs, 'enchere' => $data, 'timbres' => $timbres]);
		}
	}

	public function afficherSelonMembre($data = [])
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

		if ($encheres) {
			foreach ($encheres as &$e) {
				//mise
				$mise = new Mise();
				$miseMax = $mise->miseMax($e['idEnchere'], 'idEnchere');
				$nbMise = $mise->compte($e['idEnchere'], 'idEnchere');

				if ($miseMax && $nbMise) {
					$e['miseMax'] = $miseMax['montant'];
					$e['nbMise'] = $nbMise['compte'];
				}

				//favori
				if (isset($_SESSION['idMembre'])) {
					$favori = new Favori();
					$conditions['idMembre'] = $_SESSION['idMembre'];
					$conditions['idEnchere'] = $e['idEnchere'];
					$estFavori = $favori->selectionner($conditions);

					if ($estFavori) {
						$e['estFavori'] = 1;
					}
				}

				//temps
				$enchereInfo = $enchere->selectByField($e['idEnchere'], 'idEnchere');
				$diff = $enchere->tempsRestant($e['idEnchere']);

				$e['temps'] = $diff;
			}
		}

		//echo json_encode($encheres);
		return View::render('enchere/catalogue', ['encheres' => $encheres]);
	}

	public function afficherUn($data = [])
	{

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$enchereInfo = $enchere->selectByField($idEnchere, 'idEnchere');
		$diff = $enchere->tempsRestant($idEnchere);

		$enchereInfo['temps'] = $diff;

		$enchere_has_timbre = new Enchere_has_Timbre();
		$nbTimbre = $enchere_has_timbre->compte($idEnchere, 'idEnchere');
		$timbres = $enchere_has_timbre->selectionnerDetails($idEnchere, 'idEnchere');

		$favori = new Favori();
		$conditions['idMembre'] = $_SESSION['idMembre'];
		$conditions['idEnchere'] = $idEnchere;
		$estFavori = $favori->selectionner($conditions);

		if ($estFavori) {
			$enchereInfo['estFavori'] = 1;
		}

		foreach ($timbres as &$timbre) {
			$image = new Image();
			$images = $image->imagePrincipale($timbre['idTimbre']);
			$timbre['imageSrc'] = $images['chemin'];

			$imgs = $image->selectMultipleByField($timbre['idTimbre'], 'idTimbre');

			foreach ($imgs as $img) {
				$toutesImages[] = $img['chemin'];
			}
		}

		return View::render('enchere/voir', ['enchere' => $enchereInfo, 'nbTimbre' => $nbTimbre, 'timbres' => $timbres, 'images' => $toutesImages]);
	}

	public function supprimer($data = [])
	{
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

	public function lord($data, $data_get)
	{
		$idEnchere = $data['idEnchere'];

		if (isset($data_get['retirer'])) {
			$data['lord'] = 0;
		} elseif (isset($data_get['ajouter'])) {
			$data['lord'] = 1;
		}

		$enchere = new Enchere();
		$miseAJour = $enchere->update($data, $idEnchere);

		return $this->afficherTous();
	}

}
