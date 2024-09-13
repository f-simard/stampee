<?php

namespace App\Models;
use App\Models\CRUD;

class Pays extends CRUD {

    protected $table = "Pays";
    protected $primaryKey = 'idPays';
	protected $fillable = ['nom']; 

}