<?php

namespace App\Models;

use App\Models\CRUD;

class Enchere_has_Timbre extends CRUD
{

	protected $table = "enchere_has_timbre";
	protected $fillable = ['idTimbre', 'idEnchere'];

	final public function ajouterPlusieurs($timbres, $idEnchere)
	{
		foreach ($timbres as $timbre) {
			$relationTimbre['idTimbre'] = $timbre;
			$relationTimbre['idEnchere'] = $idEnchere;

			$ajout = $this->insert($relationTimbre);
		};
	}

	final public function compte($valeur, $champ){
		$sql = "SELECT DISTINCT count(*) as compte FROM $this->table 
		WHERE $champ = :$champ 
		GROUP BY $champ";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":$champ", $valeur);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count == 1) {
			return $stmt->fetch();
		} else {
			return false;
		}
	}

	final public function selectionnerDetails($valeur, $champ){
		$sql = "SELECT t.* FROM $this->table 
		INNER JOIN timbre as t ON  t.idTimbre =  $this->table.idTimbre
		WHERE $champ = :$champ;";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(":$champ", $valeur);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}
}
