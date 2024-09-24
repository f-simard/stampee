<?php

namespace App\Models;
use App\Models\CRUD;

class Condition extends CRUD {

    protected $table = "Condition";
    protected $primaryKey = 'idCondition';
	protected $fillable = ['nom']; 

}