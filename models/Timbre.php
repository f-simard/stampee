<?php

namespace App\Models;

use App\Models\CRUD;

class Timbre extends CRUD
{
	protected $table = "Timbre";
	protected $primaryKey = 'idTimbre';
	protected $fillable = [
		'titre',
		'description',
		'anneeProd',
		'tirage',
		'hauteur',
		'largeur',
		'certifie',
		'lord',
		'idMembre'
	];
	
	final public function selectionnerTimbresDispo($idMembre)
	{
		
		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT t.titre, t.idTimbre FROM `timbre` AS t
		LEFT JOIN `enchere_has_timbre` AS et ON t.idTimbre = et.idTimbre
		WHERE t.idMembre = ?
		AND et.idEnchere IS NULL";
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
