<?php

namespace App\Models;

use App\Models\CRUD;

class Enchere_has_Timbre extends CRUD
{

	protected $table = "Enchere_has_Timbre";
	protected $fillable = ['idTimbre', 'idEnchere'];

	final public function ajouterPlusieurs($timbres, $idEnchere)
	{
		foreach ($timbres as $timbre) {
			$relationTimbre['idTimbre'] = $timbre;
			$relationTimbre['idEnchere'] = $idEnchere;

			$ajout = $this->insert($relationTimbre);
		};
	}
}
