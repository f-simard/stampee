<?php

namespace App\Models;
use App\Models\CRUD;

class Langue extends CRUD {

    protected $table = "langue";
    protected $primaryKey = 'idLangue';
	protected $fillable = ['nom']; 

}