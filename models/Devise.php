<?php

namespace App\Models;
use App\Models\CRUD;

class Devise extends CRUD {

    protected $table = "Devise";
    protected $primaryKey = 'idDevise';
	protected $fillable = ['code', 'nom']; 

}