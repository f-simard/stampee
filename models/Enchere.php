<?php

namespace App\Models;

use App\Models\CRUD;
use DateTime;

class Enchere extends CRUD
{
	protected $table = "enchere";
	protected $primaryKey = 'idEnchere';
	protected $fillable = [
		'dateDebut',
		'description',
		'dateFin',
		'prixPlancher',
		'estimation',
		'idDevise',
		'lord'
	];
	private $sql;
	private $conditions;
	private $having = [];

	public function selectionnerSelonMembre($idMembre)
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		WHERE t.idMembre = ?
		GROUP BY e.idEnchere;";

		$stmt = $this->prepare($sql);
		$stmt->execute(array($idMembre));

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectionnerCatalogue()
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre, t.*, img.chemin FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
		WHERE img.principale = 1
		AND e.statut <> 'FERME'
		GROUP BY e.idEnchere";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectionnerArchive()
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(t.idTimbre) as nbTimbre, t.*, img.chemin FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
		WHERE img.principale = 1
		AND e.statut = ''
		GROUP BY e.idEnchere";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function filtreCatalogue()
	{
		$this->sql  = "SELECT DISTINCT e.*, count(distinct t.idTimbre) as nbTimbre, t.*, img.chemin , MAX(m.montant) as misecourante FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
        LEFT JOIN mise as m on m.idEnchere = e.idEnchere
		WHERE img.principale = 1
		AND e.statut <> 'FERME'";

		return $this;
	}

	public function filtreCatalogueArchive()
	{
		$this->sql  = "SELECT DISTINCT e.*, count(distinct t.idTimbre) as nbTimbre, t.*, img.chemin , MAX(m.montant) as misecourante FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
        LEFT JOIN mise as m on m.idEnchere = e.idEnchere
		WHERE img.principale = 1
		AND e.statut = 'FERME'";

		return $this;
	}


	public function conditions($data = [])
	{
		if (empty($data)) {
			return $this;
		} else {
			foreach ($data as $champ => $valeur) {
				$tableSegment = explode('|', $champ);
				$table = $tableSegment[0];
				$colonne = $tableSegment[1];
				$operateur = $tableSegment[2];

				if ($table == '') {

					switch ($operateur) {
						case 'E':
							if (count($this->having) > 0) {
								$this->having[] = " AND $colonne = :" . $colonne;
							} else {
								$this->having[] = " HAVING $colonne = :" . $colonne;
							}
							$this->conditions[':' . $colonne] = $valeur;
							break;
						case 'PGE':
							if (count($this->having) > 0) {
								$this->having[] = " AND $colonne >= :" . $colonne . "min";
							} else {
								$this->having[] = " HAVING $colonne >= :" . $colonne . "min";
							}
							$this->conditions[':' . $colonne . "min"] = $valeur;
							break;
						case 'PPE':
							if (count($this->having) > 0) {
								$this->having[] = " AND $colonne <= :" . $colonne . "max";
							} else {
								$this->having[] = " HAVING $colonne <= :" . $colonne . "max";
							}
							$this->conditions[':' . $colonne . "max"] = $valeur;
							break;
					}
				} else {
					switch ($operateur) {
						case 'I':
							$valeurTableau = explode(',', $valeur);
							$cleTableau = '';
							foreach ($valeurTableau as $index => $valeur) {
								$cleTableau = $cleTableau . ':' . $colonne . $index . ',';
								$this->conditions[':' . $colonne . $index] = $valeur;
							}
							$cleTableau = rtrim($cleTableau, ',');
							$this->sql = $this->sql . " AND $table.$colonne IN ( $cleTableau ) ";
							break;
						case 'E':
							$this->sql = $this->sql . " AND $table.$colonne = :" . $colonne;
							$this->conditions[':' . $colonne] = $valeur;
							break;
						case 'PGE':
							$this->sql = $this->sql . " AND $table.$colonne  >=" . $colonne;
							$this->conditions[':' . $colonne] = $valeur;
							break;
						case 'PPE':
							$this->sql = $this->sql . " AND $table.$colonne  <= :" . $colonne;
							$this->conditions[':' . $colonne] = $valeur;
							break;
					}
				}
			}
		}

		return $this;
	}

	public function executerFiltre()
	{
		$this->sql = $this->sql . " GROUP BY e.idEnchere";

		if (!empty($this->having)) {
			foreach ($this->having as $having) {
				$this->sql = $this->sql . $having;
			}
		}

		$stmt = $this->prepare($this->sql);
		if (!empty($this->conditions)) {
			foreach ($this->conditions as $cle => $valeur) {
				$stmt->bindValue(":$cle", $valeur);
			}
		}

		$stmt->execute($this->conditions);

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function proprietaire($idEnchere){
		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT t.idMembre FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		WHERE e.idEnchere = ?
		GROUP BY e.idEnchere;";

		$stmt = $this->prepare($sql);
		$stmt->execute(array($idEnchere));

		$count = $stmt->rowCount();

		if ($count == 1) {
			return $stmt->fetch();
		} else {
			return false;
		}
	}

	public function tempsRestant($idEnchere)
	{

		$maintenant = new DateTime();

		$enchereInfo = $this->selectByField($idEnchere, 'idEnchere');

		$dateDebut = new DateTime($enchereInfo['dateDebut']);
		$dateFin = new DateTime($enchereInfo['dateFin']);

		if ($maintenant < $dateDebut) {
			$diff = $maintenant->diff($dateDebut);
			$temps['avantDebut'] = $diff->format('%a jours %HH');
			return $temps;
		}
		if ($maintenant < $dateFin) {
			$diff = $maintenant->diff($dateFin);
			$temps['avantFin'] = $diff->format('%a jours %HH');
			return $temps;
		} else {
			$temps['fermee'] = null;
			return $temps;
		}
	}

	public function selectionnerSelonFavori($data = [])
	{
		$sql = "SELECT DISTINCT e.*, count(distinc t.idTimbre) as nbTimbre, t.*, img.chemin FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
		INNER JOIN favori AS f ON f.idEnchere = e.idEnchere
		WHERE img.principale = 1
		AND f.idMembre = ?
		GROUP BY e.idEnchere;";

		$stmt = $this->prepare($sql);
		$stmt->execute(array($_SESSION['idMembre']));

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}

	public function selectionner4Lord()
	{

		/*$sql = "SELECT * FROM $table WHERE $field = ?";*/
		$sql = "SELECT DISTINCT e.*, count(distinct t.idTimbre) as nbTimbre, t.*, img.chemin FROM $this->table as e
		INNER JOIN enchere_has_timbre AS et ON et.idEnchere = e.idEnchere
		INNER JOIN timbre AS t ON t.idTimbre = et.idTimbre
		INNER JOIN image AS img ON img.idTimbre = t.idTimbre
		WHERE img.principale = 1
		AND e.statut <> 'FERME'
		AND e.lord = 1
		GROUP BY e.idEnchere
		LIMIT 4";

		$stmt = $this->prepare($sql);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count >= 1) {
			return $stmt->fetchAll();
		} else {
			return false;
		}
	}
}
