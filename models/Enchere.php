<?php

namespace App\Models;

use App\Models\CRUD;

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
		'idDevise'
	];
	
	public function selectionnerSelonMembre($idMembre)
	{
		
		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre FROM `enchere` as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
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
}
