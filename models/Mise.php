<?php

namespace App\Models;

use App\Models\CRUD;

class Mise extends CRUD
{
	protected $table = "Mise";
	protected $fillable = [
		'idMembre',
		'idEnchere',
		'montant'
	];

	public function miseMax($valeur, $champ){
		$sql = "SELECT $this->table.montant FROM $this->table WHERE $champ = :$champ ORDER BY 'dateCreation' LIMIT 1;";
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

	public function compte($valeur, $champ)
	{
		$sql = "SELECT DISTINCT COUNT(*) as compte FROM $this->table WHERE $champ = :$champ GROUP BY $champ;";
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
}