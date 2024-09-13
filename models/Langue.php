<?php

namespace App\Models;
use App\Models\CRUD;

class Langue extends CRUD {

    protected $table = "Langue";
    protected $primaryKey = 'idLangue';
	protected $fillable = ['nom']; 

}