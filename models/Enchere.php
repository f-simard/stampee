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
}
