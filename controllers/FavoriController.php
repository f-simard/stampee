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

class FavoriController{

	public function creer($data=[]){

		try{
			Auth::session();

			$data['idMembre'] = $_SESSION['idMembre'];

			$favori = new Favori();
			$favoriAjoute = $favori->insert($data);

			View::render('enchere/voir', ['idEnchere'=>$data['idEnchere']]);

			// View::redirect('enchere/voir?idEnchere=' . $data['idEnchere']);
		} catch(\Exception $e){
			View::render('erreur',['msg'=> $e->getMessage()]);
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

				View::redirect('enchere/voir?idEnchere=' . $data['idEnchere']);
			} catch (\Exception $e) {
				View::render('erreur', ['msg' => $e->getMessage()]);
			}

		}
	}

	public function afficherSelonMembre() {
		$enchere = new Enchere();
		$encheres = $enchere->selectionnerSelonFavori();

		foreach ($encheres as &$e) {
			$mise = new Mise();
			$miseMax = $mise->miseMax($e['idEnchere'], 'idEnchere');
			$nbMise = $mise->compte($e['idEnchere'], 'idEnchere');

			if ($miseMax && $nbMise) {
				$e['miseMax'] = $miseMax['montant'];
				$e['nbMise'] = $nbMise['compte'];
			}

			$favori = new Favori();
			$conditions['idMembre'] = $_SESSION['idMembre'];
			$conditions['idEnchere'] = $e['idEnchere'];
			$estFavori = $favori->selectionner($conditions);

			if ($estFavori) {
				$e['estFavori'] = 1;
			}
		}

		return View::render('favori/parMembre', ['encheres' => $encheres]);
	}


}
