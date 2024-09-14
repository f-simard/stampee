<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;

use App\Models\Membre;
use App\Models\Timbre;

class MembreController
{

	public function creer()
	{

		return View::render('timbre/creer');
	}

	public function voir($data = [])

	{
		if (isset($data['idMembre']) && $data['idMembre'] != null) {

			$idMembre = $data['idMembre'];

			//récuperer user
			$membre = new Membre();
			$membreSelect = $membre->selectByField($idMembre);

			if ($membreSelect) {
				return View::render('membre/voir', ['membre' => $membreSelect]);
			} else {
				return View::render('erreur', ['msg' => "Membre inexistant"]);
			}
		} else {
			return View::render('erreur', ['msg' => "Page  introuvable"]);
		}
	}

	public function sauvegarder($data = [])
	{
		$validateur = new Validator();
		if ($_FILES["fichierATeleverser"]["size"] > 0 || $_FILES["fichierATeleverser"]["error"] == 1) {
			$validateur->champ('fichierATeleverser', $_FILES, "Image")->image();
		}
		$validateur->champ('prenom', $data['prenom'], "Prénom")->nettoie()->min(2)->max(45);
		$validateur->champ('nom', $data['nom'], "Nom de famille")->nettoie()->min(2)->max(45);
		$validateur->champ('nomUtilisateur', $data['nomUtilisateur'], "Nom d'usager")->nettoie()->contientEspace()->min(3)->max(45)->unique('Membre');
		$validateur->champ('courriel', $data['courriel'])->requis()->nettoie()->courriel()->max(100)->unique('Membre');
		$validateur->champ('motDePasse', $data['motDePasse'], "Mot de passe")->requis()->nettoie()->min(3)->max(45);
		$validateur->champ('adresseCivique', $data['adresseCivique'], "Adresse")->nettoie()->max(255);
		$validateur->champ('codePostal', $data['codePostal'], "code postal")->codePostalNA();
		$validateur->champ('ville', $data['ville'], "Ville")->max(100);
		$validateur->champ('idPays', $data['idPays'], 'Pays')->requis()->existe('Pays', 'idPays');
		$validateur->champ('idLangue', $data['idLangue'], 'Langue')->requis()->existe('Langue', 'idLangue');
		$validateur->champ('idDevise', $data['idDevise'], 'Devise')->requis()->existe('Devise', 'idDevise');


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

			$erreurs = $validateur->obtenirErreur();

			$devise = new Devise;
			$devises = $devise->select('nom');

			$pays = new Pays;
			$pays_liste = $pays->select('nom');

			$langue = new Langue;
			$langues = $langue->select('nom');

			return View::render('membre/creer', ['erreurs' => $erreurs, 'membre' => $data, 'devises' => $devises, 'pays_liste' => $pays_liste, 'langues' => $langues]);
		}
	}
}
