<?php

namespace App\Models;

use App\Models\CRUD;

class Timbre extends CRUD
{

	protected $table = "Timbre";
	protected $primaryKey = 'idTimbre';
	protected $fillable = [
		'nom',
		'description',
		'dateProd',
		'tirage',
		'hauteur',
		'largeur',
		'certifie'
	];

}
