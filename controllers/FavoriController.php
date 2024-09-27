<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

use App\Models\Favori;
use App\Models\Pays;
use App\Models\Condition;


class FavoriController
{

	public function creer($data = [])
	{

		try {
			Auth::session();

			$data['idMembre'] = $_SESSION['idMembre'];

			$favori = new Favori();
			$favoriAjoute = $favori->insert($data);

			echo 'a ajouté';

			// View::redirect('enchere/voir?idEnchere=' . $data['idEnchere']);
		} catch (\Exception $e) {
			View::render('erreur', ['msg' => $e->getMessage()]);
		}
	}

	public function supprimer($data = [])
	{
		Auth::session();

		if (isset($data['idEnchere']) && $data['idEnchere'] != null) {

			$idEnchere = $data['idEnchere'];

			try {
				Auth::session();

				$data['idMembre'] = $_SESSION['idMembre'];

				$favori = new Favori();
				$favoriSupprime = $favori->supprimerFavori($data);

				echo 'a retiré';

				//View::redirect('enchere/voir?idEnchere=' . $data['idEnchere']);
			} catch (\Exception $e) {
				View::render('erreur', ['msg' => $e->getMessage()]);
			}
		}
	}

	public function afficherSelonMembre()
	{
		$pays = new Pays;
		$pays_liste = $pays->select('nom');

		$condition = new Condition();
		$conditions = $condition->select();

		$maintenant = new \DateTime();
		$maintenant = $maintenant->format('Y-m-d');

		//echo json_encode($encheres);
		return View::render('favori/parMembre', ['pays_liste' => $pays_liste, 'conditions' => $conditions, 'aujourdhui' => $maintenant]);
	}
}
