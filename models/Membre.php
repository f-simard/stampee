<?php

namespace App\Models;

use App\Models\CRUD;

class Membre extends CRUD
{

	protected $table = "Membre";
	protected $primaryKey = 'idMembre';
	protected $fillable = [
		'nomUtilisateur',
		'nom',
		'prenom',
		'adresseCivique',
		'ville',
		'codePostal',
		'courriel',
		'avatar',
		'idPays',
		'idLangue',
		'idDevise',
		'motDePasse',
		'estAdmin'
	];
	private $sel = 'g7!P92';

	/*encrypter les mots de passe*/
	public function hashMotDePasse($motDePasse, $cout = 10)
	{
		$options = [
			'cost' => $cout
		];

		return password_hash($motDePasse . $this->sel, PASSWORD_BCRYPT, $options);
	}


	/* authentifier l'utilisteur */
	public function verifierMembre($nomUtilisateur, $motDePasse)
	{

		$membre = $this->unique('nomUtilisateur', $nomUtilisateur);

		if ($membre) {
			if (password_verify($motDePasse . $this->sel, $membre['motDePasse'])) {

				session_regenerate_id();
				$_SESSION['idMembre'] = $membre['idMembre'];
				$_SESSION['nomUtilisateur'] = $membre['nomUtilisateur'];
				$_SESSION['estAdmin'] = $membre['estAdmin'];
				$_SESSION['prenom'] = $membre['prenom'];
				$_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

				return true;
			} else {
				return false;
			}
			return $membre;
		} else {
			return false;
		}
	}
}
