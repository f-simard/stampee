<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

use App\Models\Favori;

class FavoriController{

	public function creer($data=[]){

		try{
			Auth::session();

			$data['idMembre'] = $_SESSION['idMembre'];

			$favori = new Favori();
			$favoriAjoute = $favori->insert($data);

			View::redirect('enchere/voir?idEnchere=' . $data['idEnchere']);
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

	public function afficherSelonMembre() {}


}
