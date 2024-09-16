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
}
