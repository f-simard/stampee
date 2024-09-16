<?php

namespace App\Models;

use App\Models\CRUD;

class Image extends CRUD
{
	protected $table = "Image";
	protected $primaryKey = 'idImage';
	protected $fillable = [
		'chemin',
		'idTimbre',
		'principale'
	];

	final public function imagePrincipale($value){

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT * FROM `image` WHERE `idTimbre` = ? AND `principale` = 1;";
		$stmt = $this->prepare($sql);
		$stmt->execute(array($value));

		$count = $stmt->rowCount();

		if ($count == 1) {
			return $stmt->fetch();
		} else {
			return false;
		}
	}
}
