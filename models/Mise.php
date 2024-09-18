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
}