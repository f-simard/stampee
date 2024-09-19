<?php

namespace App\Models;

use App\Models\CRUD;

class Favori extends CRUD
{
	protected $table = "Favori";
	protected $fillable = ['idEnchere', 'idMembre'];

	public function supprimerFavori($data=[]){

		$data_keys = array_fill_keys($this->fillable, '');
		$data = array_intersect_key($data, $data_keys);

		$condition = '';

		foreach($data as $key=>$value){
			if($key !== array_key_first($data)){
				$condition = $condition . " AND " . "$key = :$key" ;
			} else {
				$condition = "$key = :$key";
			}
		}

		$sql = "DELETE FROM $this->table WHERE $condition;";
		$stmt = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$stmt->bindValue(":$key", $value);
		}
		$stmt->execute();

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function selectionner($data = [])
	{

		$data_keys = array_fill_keys($this->fillable, '');
		$data = array_intersect_key($data, $data_keys);

		$condition = '';

		foreach ($data as $key => $value) {
			if ($key !== array_key_first($data)) {
				$condition = $condition . " AND " . "$key = :$key";
			} else {
				$condition = "$key = :$key";
			}
		}

		$sql = "SELECT * FROM $this->table WHERE $condition;";
		$stmt = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$stmt->bindValue(":$key", $value);
		}
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count == 1) {
			return $stmt->fetch();
		} else {
			return false;
		}
	}
}
