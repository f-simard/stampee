<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;

use App\Models\Membre;
use App\Models\Timbre;

class TimbreController
{

	public function creer()
	{

		return View::render('timbre/creer');
	}

	public function sauvegarder($data = [])
	{
		$validateur = new Validator();
		if ($_FILES["imagePrincipale"]["size"] > 0 || $_FILES["imagePrincipale"]["error"] == 1) {
			$validateur->champ('imagePrincipale', $_FILES, "Image")->requis()->image("imagePrincipale");
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
		$validateur->champ('description', $data['description'])->nettoie()->min(2)->max(100);
		$validateur->champ('anneProd', $data['anneProd'],"Année de production")->requis()->toutNumeric();
		$validateur->champ('tirage', $data['tirage'])->requis()->toutNumeric()->plusGrand(0);
		$validateur->champ('hauteur', $data['hauteur'])->requis()->toutNumeric()->plusGrand(0)->plusPetit(25);
		$validateur->champ('largeur', $data['largeur'])->requis()->toutNumeric()->plusGrand(0)->plusPetit(25);




		//donner valeur tinyint à isAdmin
		if (isset($data['estAdmin'])) {
			$data['estAdmin'] = 1;
		} else {
			$data['estAdmin'] = 0;
		}

		if ($validateur->estSucces()) {
			//créer utilisateur
			$membre = new Membre();

			//encrypter mot de passe
			$password = $membre->hashMotDePasse($data['motDePasse']);
			$data['motDePasse'] = $password;

			//sauvegarder sur le serveur
			// https://stackoverflow.com/questions/15211231/server-document-root-path-in-php
			$fichierCible = $_SERVER["DOCUMENT_ROOT"] . UPLOAD . basename($_FILES["fichierATeleverser"]["name"]);
			$deplace = move_uploaded_file($_FILES["fichierATeleverser"]["tmp_name"], $fichierCible);

			//sauvegarder le chemin dans la base de donnée
			$data['avatar'] = basename($_FILES["fichierATeleverser"]["name"]);

			//créer utilisateur
			$membreAjoute = $membre->insert($data);

			return View::redirect('login');
		} else {

			return View::render('membre/creer', ['erreurs' => $erreurs, 'membre' => $data, 'devises' => $devises, 'pays_liste' => $pays_liste, 'langues' => $langues]);
		}
	}
}
