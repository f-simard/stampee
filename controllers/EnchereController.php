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
use App\Models\Pays;
use App\Models\Condition;

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

		if ($data['estimation'] == '') {
			unset($data['estimation']);
		}

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

	public function afficherCatalogue()
	{
		$pays = new Pays;
		$pays_liste = $pays->select('nom');

		$condition = new Condition();
		$conditions = $condition->select();

		$maintenant = new \DateTime();
		$maintenant = $maintenant->format('Y-m-d');

		//echo json_encode($encheres);
		return View::render('enchere/catalogue', ['pays_liste' => $pays_liste, 'conditions' => $conditions, 'aujourdhui' => $maintenant]);
	}

	//returne de json

	public function afficherArchive()
	{
		$pays = new Pays;
		$pays_liste = $pays->select('nom');

		$condition = new Condition();
		$conditions = $condition->select();


		$maintenant = new \DateTime();
		$maintenant = $maintenant->format('Y-m-d');


		//echo json_encode($encheres);
		return View::render('enchere/archive', ['pays_liste' => $pays_liste, 'conditions' => $conditions, 'aujourdhui' => $maintenant]);
	}

	public function recupererActiveFiltre($data = [])
	{

		$enchere = new Enchere();
		$encheres = $enchere->filtreCatalogue()->conditions($data)->executerFiltre();

		if ($encheres) {
			$encheresInfo = $this->completerDonnee($encheres);
		} else {
			$encheresInfo['msg'] = 'Aucune enchere';
		}
		echo json_encode($encheresInfo);
	}

	public function recupererArchiveFiltre($data = [])
	{

		$enchere = new Enchere();
		$encheres = $enchere->filtreCatalogueArchive()->conditions($data)->executerFiltre();

		if ($encheres) {
			$encheresInfo = $this->completerDonnee($encheres);
		} else {
			$encheresInfo['msg'] = 'Aucune enchere';
		}
		echo json_encode($encheresInfo);
	}

	public function recupererFavoriFiltre($data = [])
	{

		$enchere = new Enchere();
		$encheres = $enchere->filtreCatalogueFavori()->conditions($data)->executerFiltre();

		if ($encheres) {
			$encheresInfo = $this->completerDonnee($encheres);
		} else {
			$encheresInfo['msg'] = 'Aucune enchere';
		}
		echo json_encode($encheresInfo);
	}

	public function recupererUn($data = [])
	{

		$idEnchere = $data['idEnchere'];
		$conditions['e|idEnchere|E'] = $idEnchere;

		$enchere = new Enchere();
		$encheresInfo = $enchere->filtreCatalogue()->conditions($conditions)->executerFiltre();

		$enchereInfo = $encheresInfo[0];

		$mise = new Mise();
		$miseMax = $mise->miseMax($enchereInfo['idEnchere'], 'idEnchere');
		$nbMise = $mise->compte($enchereInfo['idEnchere'], 'idEnchere');

		if ($miseMax && $nbMise) {
			$enchereInfo['miseMax'] = $miseMax['montant'];
			$enchereInfo['nbMise'] = $nbMise['compte'];
		}

		if (isset($_SESSION['idMembre'])) {
			$favori = new Favori();
			$conditions['idMembre'] = $_SESSION['idMembre'];
			$conditions['idEnchere'] = $enchereInfo['idEnchere'];
			$estFavori = $favori->selectionner($conditions);

			if ($estFavori) {
				$enchereInfo['estFavori'] = 1;
			}
		}

		$diff = $enchere->tempsRestant($idEnchere);
		$enchereInfo['temps'] = $diff;

		echo json_encode($enchereInfo);
	}

	public function afficherUn($data = [])
	{

		$idEnchere = $data['idEnchere'];

		$enchere = new Enchere();
		$enchereInfo = $enchere->selectByField($idEnchere, 'idEnchere');

		if($enchereInfo){
			$proprietaire = $enchere->proprietaire($idEnchere);

			$diff = $enchere->tempsRestant($idEnchere);

			$enchereInfo['temps'] = $diff;

			$mise = new Mise();
			$miseMax = $mise->miseMax($enchereInfo['idEnchere'], 'idEnchere');
			$enchereInfo['misecourante'] = $miseMax['montant'];

			$enchere_has_timbre = new Enchere_has_Timbre();
			$nbTimbre = $enchere_has_timbre->compte($idEnchere, 'idEnchere');
			$timbres = $enchere_has_timbre->selectionnerDetails($idEnchere, 'idEnchere');

			if (isset($_SESSION['idMembre'])) {
				$favori = new Favori();
				$conditions['idMembre'] = $_SESSION['idMembre'];
				$conditions['idEnchere'] = $idEnchere;
				$estFavori = $favori->selectionner($conditions);
			} else {
				$estFavori = false;
			}

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

				$condition = new Condition;
				$timbreCondition = $condition->selectByField($timbre['idCondition'], 'idCondition');
				$timbre['nomCondition'] = $timbreCondition['nom'];
			}

			return View::render('enchere/voir', [
				'enchere' => $enchereInfo,
				'proprietaire' => $proprietaire,
				'nbTimbre' => $nbTimbre,
				'timbres' => $timbres,
				'images' => $toutesImages
			]);
		} else {
			return View::render('erreur', ['msg' => 'Enchere introuvable']);
		}

	
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

		return $this->afficherCatalogue();
	}

	public function completerDonnee($encheres)
	{
		$enchere = new Enchere();

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
			$diff = $enchere->tempsRestant($e['idEnchere']);

			$e['temps'] = $diff;
		}

		return $encheres;
	}
}
