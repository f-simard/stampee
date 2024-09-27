<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

use App\Models\Timbre;
use App\Models\Image;
use App\Models\Enchere_has_Timbre;
use App\Models\Enchere;
use App\Models\Pays;
use App\Models\Condition;

class TimbreController
{

	public function creer()
	{
		Auth::session();

		$pays = new Pays;
		$pays_liste = $pays->select('nom');

		$condition = new Condition();
		$conditions = $condition->select();

		return View::render('timbre/creer', ['pays_liste' => $pays_liste, 'conditions' => $conditions]);
	}

	public function sauvegarder($data = [])
	{
		Auth::session();

		/*TODO: ameliorer avec boucle pour $_FILES*/
		$validateur = new Validator();
		if ($_FILES["imagePrincipale"]["size"] > 0 || ($_FILES["imagePrincipale"]["error"] > 0)) {
			$validateur->champ('imagePrincipale', $_FILES, "Image")->imgRequise("imagePrincipale")->image("imagePrincipale");
		}
		if ($_FILES["image2"]["size"] > 0 || $_FILES["image2"]["error"] == 1) {
			$validateur->champ('image2', $_FILES, "Image")->image("image2");
		}
		if ($_FILES["image3"]["size"] > 0 || $_FILES["image3"]["error"] == 1) {
			$validateur->champ('image3', $_FILES, "Image")->image("image3");
		}
		if ($_FILES["image4"]["size"] > 0 || $_FILES["image4"]["error"] == 1) {
			$validateur->champ('image4', $_FILES, "Image")->image("image4");
		}
		if ($_FILES["image5"]["size"] > 0 || $_FILES["image5"]["error"] == 1) {
			$validateur->champ('image5', $_FILES, "Image")->image("image5");
		}

		$validateur->champ('titre', $data['titre'])->nettoie()->min(2)->max(100);
		$validateur->champ('description', $data['description'])->nettoie()->max(100);
		$validateur->champ('anneeProd', $data['anneeProd'], "Année de production")->requis()->toutNumeric();
		$validateur->champ('tirage', $data['tirage'])->toutNumeric()->plusGrand(0);
		$validateur->champ('hauteur', $data['hauteur'])->requis()->toutNumeric()->plusGrand(0)->plusPetit(25);
		$validateur->champ('largeur', $data['largeur'])->requis()->toutNumeric()->plusGrand(0)->plusPetit(25);
		$validateur->champ('idPays', $data['idPays'], 'Pays')->requis()->existe('Pays', 'idPays');
		$validateur->champ('idCondition', $data['idCondition'], 'Condition')->requis()->existe('Condition', 'idCondition');

		//ajouter et manipuler data
		if (isset($data['certifie'])) {
			$data['certifie'] = 1;
		} else {
			$data['certifie'] = 0;
		}
		if ($data['tirage'] == '') {
			unset($data['tirage']);
		}


		$data['idMembre'] = $_SESSION['idMembre'];


		if ($validateur->estSucces()) {

			//créer utilisateur
			$timbre = new Timbre();

			//créer timbre
			$timbreAjoute = $timbre->insert($data);

			// sauvegarder image sur le serveur
			// https://stackoverflow.com/questions/15211231/server-document-root-path-in-php

			foreach ($_FILES as $nom => $fichier) {
				if ($fichier['error'] == 0) {
					$fichierCible = $_SERVER["DOCUMENT_ROOT"] . UPLOAD . basename($fichier["name"]);
					$deplace = move_uploaded_file($fichier["tmp_name"], $fichierCible);

					//creer lien dans base de données
					$donneeImage['chemin'] = basename($fichier["name"]);
					$donneeImage['idTimbre'] = $timbreAjoute;

					if ($nom == 'imagePrincipale') {
						$donneeImage['principale'] = 1;
					} else {
						$donneeImage['principale'] = 0;
					}

					$image = new Image();
					$imageAjoute = $image->insert($donneeImage);
				}
			}

			return View::redirect('timbre/voir?idTimbre=' . $timbreAjoute);
		} else {

			$erreurs = $validateur->obtenirErreur();

			$pays = new Pays;
			$pays_liste = $pays->select('nom');

			$condition = new Condition();
			$conditions = $condition->select();

			return View::render('timbre/creer', ['erreurs' => $erreurs, 'timbre' => $data, 'pays_liste' => $pays_liste, 'conditions' => $conditions]);
		}
	}

	public function afficherSelonMembre()
	{
		Auth::session();
		$timbre = new Timbre();
		$timbres = $timbre->selectMultipleByField($_SESSION['idMembre'], 'idMembre');

		foreach ($timbres as &$timbre) {
			$image = new Image();
			$images = $image->imagePrincipale($timbre['idTimbre']);
			$timbre['imageSrc'] = $images['chemin'];

			$enchere_has_timbre = new Enchere_has_Timbre;
			$enchereRelation = $enchere_has_timbre->selectByField($timbre['idTimbre'], 'idTimbre');

			if (!$enchereRelation) {
				$timbre['statutEnchere'] = 'Sans enchère';
			} else {
				$enchere = new Enchere;
				$enchereInfos = $enchere->selectByField($enchereRelation['idEnchere'], 'idEnchere');

				$timbre['statutEnchere'] = $enchereInfos['statut'];
			}
		}

		return View::render('timbre/parMembre', ['timbres' => $timbres]);
	}

	public function afficherUn($data = [])
	{

		$idTimbre = $data['idTimbre'];

		$timbre = new Timbre();
		$timbreInfo = $timbre->selectByField($idTimbre, 'idTimbre');

		if ($timbreInfo) {

			$image = new Image();
			$images = $image->selectMultipleByField($idTimbre, 'idTimbre');

			$pays = new Pays();
			$origine = $pays->selectByField($timbreInfo['idPays'], 'idPays');

			$condition = new Condition();
			$conditions = $condition->selectByField($timbreInfo['idCondition'], 'idCondition');

			foreach ($images as $img) {
				$chemins[] = $img['chemin'];
			}

			return View::render('timbre/voir', ['timbre' => $timbreInfo, 'images' => $chemins, 'pays' => $origine, 'condition' => $conditions]);
		} else {
			return View::render('erreur', ['msg' => 'Timbre introuvable']);
		}
	}
}
