<?php

namespace App\Providers;

use App\Models;
use DateTime;

class Validator
{

	private $erreurs = array();
	private $cle;
	private $valeur;
	private $nom;

	//si le champ existe + creation du field dans le validator
	public function champ($cle, $valeur, $nom = null)
	{
		$this->cle = $cle;
		$this->valeur = $valeur;

		if ($nom == null) {
			$this->nom = ucfirst($cle);
		} else {
			$this->nom = ucfirst($nom);
		}

		//pour permettre d'enchainer les references
		return $this;
	}

	//si le champ est requis
	public function requis()
	{
		if (empty($this->valeur)) {
			$this->erreurs[$this->cle] = "$this->nom est requis";
		}
		return $this;
	}

	//si le champ est requis
	public function nettoie()
	{
		if (!empty($this->valeur)) {
			$this->valeur = trim($this->valeur);
		}
		return $this;
	}

	//max length
	public function max($longueur)
	{
		if (strlen($this->valeur) > $longueur) {
			$this->erreurs[$this->cle] = "$this->nom doit contenir moins que $longueur caractères";
		}
		return $this;
	}

	//min
	public function min($longueur)
	{
		if (strlen($this->valeur) < $longueur) {
			$this->erreurs[$this->cle] = "$this->nom doit contenir plus que $longueur charactères";
		}
		return $this;
	}

	//email, valider que vide pour valider format, si vide, ignore
	public function courriel()
	{
		if (!empty($this->valeur) && !filter_var($this->valeur, FILTER_VALIDATE_EMAIL)) {
			$this->erreurs[$this->cle] = "Format de $this->nom invalide.";
		}
		return $this;
	}

	//unique, vérifier si la valeur pour le champ entrée existe déjà dans la base de donnée
	public function unique($model, $champException = null, $valeurException = null)
	{
		$model = 'App\\Models\\' . $model;
		$model = new $model;

		if ($champException && $valeurException) {
			$unique = $model->unique($this->cle, $this->valeur, $champException, $valeurException);
		} else {
			$unique = $model->unique($this->cle, $this->valeur);
		}

		if ($unique) {
			$this->erreurs[$this->cle] = "$this->nom doit être unique";
		}
		return $this;
	}

	public function existe($model, $champ = 'id')
	{
		$model = 'App\\Models\\' . $model;
		$model = new $model;

		$exist = $model->unique($champ, $this->valeur);
		if (!$exist) {
			$this->erreurs[$this->cle] = "$this->nom doit exister";
		}
		return $this;
	}

	public function image($nom)
	{

		if ($_FILES["imagePrincipale"]["error"] !=4 ) {
			/* src:https://www.php.net/manual/en/features.file-upload.errors.php */
			if ($this->valeur[$nom]["error"] > 0) {
				$this->erreurs[$this->cle] = "Une erreur est survenue avec l'image.";
				return $this;
			};

			$fichier_cible = $_SERVER["DOCUMENT_ROOT"] . UPLOAD . basename($this->valeur[$nom]["name"]);
			$typeImg = strtolower(pathinfo($fichier_cible, PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			$verification = getimagesize($this->valeur[$nom]["tmp_name"]);
			if ($verification == false) {
				$this->erreurs[$this->cle] = "Format de $this->nom invalide.";
			};

			// Check file size
			if ($this->valeur[$nom]["size"] > 200000) {
				$this->erreurs[$this->cle] = "L'image est trop grande";
			}

			// Allow certain file formats
			if (
				$typeImg != "jpg" && $typeImg != "png" && $typeImg != "jpeg"
				&& $typeImg != "gif"
			) {
				$this->erreurs[$this->cle] = "Seul les JPG, JPEG, PNG & GIF sont acceptés";
			}

			return $this;
		}
		
	}

	public function imgRequise($nom){
		 if ($_FILES[$nom]["error"] == 4){
			$this->erreurs[$this->cle] = "$this->nom requise";
		}
		return $this;
	}

	public function codePostalNA(){
		$exp= '/^((\d{5}-\d{4})|(\d{5})|([A-Z]\d[A-Z]\s\d[A-Z]\d))$/';

		//src pour reg ex: https://regexlib.com/Search.aspx?k=canadian+postal+code&AspxAutoDetectCookieSupport=1
		if (!empty($this->valeur) && !preg_match($exp, $this->valeur)) {
			$this->erreurs[$this->cle] = "Format $this->nom invalide";
		}

		return $this;
	}

	public function contientEspace()
	{
		//src pour reg ex: https://forum.freecodecamp.org/t/find-whitespace-with-regular-expressions-solved/25194
		if (preg_match('/\s/', $this->valeur)) {
			$this->erreurs[$this->cle] = "La valeur ne peux pas contenir d'espace";
		}

		return $this;
	}

	// tout numerique
	public function toutNumeric()
	{
		if (!empty($this->valeur) && !is_numeric($this->valeur)) {
			$this->erreurs[$this->cle] = "$this->nom doit être un nombre";
		}
		return $this;
	}

	public function plusPetit($limite)
	{
		if (!empty($this->valeur) && $this->valeur >= $limite) {
			$this->erreurs[$this->cle] = "$this->nom doit être plus petit ou égal à $limite.";
		}
		return $this;
	}

	public function plusGrand($limite)
	{
		if (!empty($this->valeur) && $this->valeur <= $limite) {
			$this->erreurs[$this->cle] = "$this->nom doit être plus grand ou equal à $limite.";
		}
		return $this;
	}

	public function formatDate($format = 'Y-m-d')
	{
		$date = \DateTime::createFromFormat($format, $this->valeur);
		if (!$date || $date->format($format) !== $this->valeur) {
			$this->erreurs[$this->cle] = "Format de date invalide. Merci d'utiliser le format suivant $format.";
		}
		return $this;
	}

	public function auMoinsUn(){
		if($this->valeur == null){
			$this->erreurs[$this->cle] = "Sélectionner au moins un $this->nom ";
		}
		return $this;
	}

	public function future(){
		$dateSoumise = new DateTime($this->valeur);
		$maintenant = new DateTime();
		if ($dateSoumise < $maintenant) {
			return $this->erreurs[$this->cle] = "La date doit être dans le future";
		}

		return $this;
	}

	public function avantDebut($debut){
		$dateFin = new DateTime($this->valeur);
		$dateDebut = new DateTime($debut);

		if ($dateFin < $dateDebut) {
			return $this->erreurs[$this->cle] = "La date de fin doit être plus grande que la date de debut";
		}
		return $this;
	}

	//if no errors, then success
	public function estSucces()
	{
		if (empty($this->erreurs)) return true;
	}

	//if not success, then error
	public function obtenirErreur()
	{
		if (!$this->estSucces()) return $this->erreurs;
	}
}
