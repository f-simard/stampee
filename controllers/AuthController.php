<?php

namespace App\Controllers;

use App\Models\Membre;
use App\Providers\View;
use App\Providers\Validator;

class AuthController
{

	public function index()
	{

		if (isset($_SESSION['idMembre'])) {
			return View::redirect('membre/voir?idMembre=' . $_SESSION['idMembre']);
		}
		View::render('auth/index');
	}

	public function accesRefuse()
	{
		return View::render('accessDenied');
	}

	public function sauvegarder($data = [])
	{
		//valider donnée
		$validateur = new Validator();
		$validateur->champ('nomUtilisateur', $data['nomUtilisateur'])->nettoie()->requis()->max(50)->existe('Membre', 'nomUtilisateur');
		$validateur->champ('motDePasse', $data['motDePasse'])->nettoie()->requis()->min(4)->max(255);


		if ($validateur->estSucces()) {

			$membre = new Membre;
			$membreVerifie = $membre->verifierMembre($data['nomUtilisateur'], $data['motDePasse']);
			$idMembre = $_SESSION['idMembre'];


			if ($membreVerifie) {

				return View::redirect('membre/voir?idMembre=' . $idMembre);
			} else {
				$erreurs['message'] = 'Veuillez vérifier vos informations';
				return View::render('auth/index', ['erreurs' => $erreurs, 'membre' => $data]);
			}
		} else {

			echo 'erreur';
			$erreurs = $validateur->obtenirErreur();

			return View::render('auth/index', ['erreurs' => $erreurs, 'membre' => $data]);
		}
	}

	public function supprimer()
	{
		session_destroy();
		return View::redirect('connexion');
	}

	public function estAdmin()
	{
		$data = [];
		if (isset($_SESSION['estAdmin'])) {
			$data['estAdmin'] = $_SESSION['estAdmin'];
		} else {
			$data['estAdmin'] = 0;
		}

		echo json_encode($data);
	}

	public function idMembre()
	{
		$data = [];
		if (isset($_SESSION['idMembre'])) {
			$data['idMembre'] = $_SESSION['idMembre'];
		} else {
			$data['idMembre'] = 'guest';
		}

		echo json_encode($data);
	}
}
