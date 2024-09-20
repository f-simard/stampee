<?php

namespace App\Models;

use App\Models\CRUD;
use DateTime;

class Enchere extends CRUD
{
	protected $table = "Enchere";
	protected $primaryKey = 'idEnchere';
	protected $fillable = [
		'dateDebut',
		'description',
		'dateFin',
		'prixPlancher',
		'estimation',
		'idDevise',
		'lord'
	];

	public function selectionnerSelonMembre($idMembre)
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre FROM `Enchere` as e
		INNER JOIN Enchere_has_Timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN Timbre AS t ON t.idTimbre = et.idTimbre
		WHERE t.idMembre = ?
		GROUP BY e.idEnchere;";

		$stmt = $this->prepare($sql);
		$stmt->execute(array($idMembre));

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectionnerCatalogue()
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre, t.*, img.chemin FROM `Enchere` as e
		INNER JOIN Enchere_has_Timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN Timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN Image AS img ON img.idTimbre = t.idTimbre
		WHERE img.principale = 1
		AND e.statut <> 'FERMEE'
		GROUP BY e.idEnchere";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function tempsRestant($idEnchere){

		$maintenant = new DateTime();

		$enchereInfo = $this->selectByField($idEnchere, 'idEnchere');

		$dateDebut = new DateTime($enchereInfo['dateDebut']);
		$dateFin = new DateTime($enchereInfo['dateFin']);

		if($maintenant < $dateDebut){
			$diff = $maintenant->diff($dateDebut);
			$temps['avantDebut'] = $diff->format('%a jours %HH');
			return $temps;
		} if ($maintenant < $dateFin){
			$diff = $maintenant->diff($dateFin);
			$temps['avantFin'] = $diff->format('%a jours %HH');
			return $temps;
		} else {
			$temps['fermee'] = null;
			return $temps;
		}

	}

	public function selectionnerSelonFavori($data=[]){
		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre, t.*, img.chemin FROM `Enchere` as e
		INNER JOIN Enchere_has_Timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN Timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN Image AS img ON img.idTimbre = t.idTimbre
		INNER JOIN Favori AS f ON f.idEnchere = e.idEnchere
		WHERE img.principale = 1
		GROUP BY e.idEnchere;";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectionner4Lord()
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre, t.*, img.chemin FROM `Enchere` as e
		INNER JOIN Enchere_has_Timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN Timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN Image AS img ON img.idTimbre = t.idTimbre
		WHERE img.principale = 1
		AND e.statut <> 'FERMEE'
		AND e.lord = 1
		GROUP BY e.idEnchere
		LIMIT 4";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

}
