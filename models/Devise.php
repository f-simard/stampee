<?php

namespace App\Models;
use App\Models\CRUD;

class Devise extends CRUD {

    protected $table = "devise";
    protected $primaryKey = 'idDevise';
	protected $fillable = ['nom']; 

}