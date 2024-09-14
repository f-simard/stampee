{{ include('layouts/entete.php' , {title: 'Créer timbre'}) }}

<main>
	<h2>Créer un compte</h2>
	<form class="formulaire" method="post" enctype="multipart/form-data" novalidate>

		<div>
			<label for="imagePrincipale">Ajouter une image principale*</label>
			<input type="file" name="imagePrincipale" id="imagePrincipale" />
			{% if erreurs.imagePrincipale is defined %}
			<span class="erreur">{{erreurs.imagePrincipale}}</span>
			{% endif %}
		</div>

		<div>
			<label for="image2">Ajouter une image de support</label>
			<input type="file" name="image2" id="image2" />
			{% if erreurs.image2 is defined %}
			<span class="erreur">{{erreurs.image2}}</span>
			{% endif %}
		</div>

		<div>
			<label for="image3">Ajouter une image de support</label>
			<input type="file" name="image3" id="image3" />
			{% if erreurs.image3 is defined %}
			<span class="erreur">{{erreurs.image3}}</span>
			{% endif %}
		</div>

		<div>
			<label for="image4">Ajouter une image de support</label>
			<input type="file" name="image4" id="image4" />
			{% if erreurs.image4 is defined %}
			<span class="erreur">{{erreurs.image4}}</span>
			{% endif %}
		</div>

		<div>
			<label for="image5">Ajouter une image de support</label>
			<input type="file" name="image5" id="image5" />
			{% if erreurs.image5 is defined %}
			<span class="erreur">{{erreurs.image5}}</span>
			{% endif %}
		</div>

		<div>
			<label for="titre">Titre*</label>
			<input type="text" name="titre" id="titre" value="{{timbre.titre}}">
			{% if erreurs.nom is defined %}
			<span class="erreur">{{erreurs.nom}}</span>
			{% endif %}
		</div>

		<div>
			<label for="description">Description</label>
			<input type="text" name="description" id="description" value="{{timbre.description}}">
			{% if erreurs.description is defined %}
			<span class="erreur">{{erreurs.description}}</span>
			{% endif %}
		</div>

		<div>
			<label for="anneeProd">Année de production</label>
			<input required type="number" name="anneeProd" id="anneeProd" value="{{timbre.anneeProd}}">
			{% if erreurs.anneeProd is defined %}
			<span class="erreur">{{erreurs.anneeProd}}</span>
			{% endif %}
		</div>

		<div>
			<label for="tirage">Tirage</label>
			<input required type="number" name="tirage" id="tirage" value="{{timbre.tirage}}" min=0>
			{% if erreurs.tirage is defined %}
			<span class="erreur">{{erreurs.tirage}}</span>
			{% endif %}
		</div>

		<div>
			<label for="hauteur">Hauteur (cm)</label>
			<input required type="number" name="hauteur" id="hauteur" value="{{timbre.hauteur}}" min=0 max=25>
			{% if erreurs.hauteur is defined %}
			<span class="erreur">{{erreurs.hauteur}}</span>
			{% endif %}
		</div>

		<div>
			<label for="largeur">Largeur (cm)</label>
			<input required type="number" name="largeur" id="largeur" value="{{timbre.largeur}}" min=0 max=25>
			{% if erreurs.largeur is defined %}
			<span class="erreur">{{erreurs.largeur}}</span>
			{% endif %}
		</div>

		<div>
			<input type="checkbox" name="certifie" id="certifie" {% if timbre.certifie == 1 %} checked {% endif %}>
			<label for="certifie">Certifié</label>
		</div>

		{% if session.estAdmin == 1%}
		<div>
			<input type="checkbox" name="lord" id="lord">
			<label for="lord">Coup de coeur du Lord</label>
		</div>
		{% endif %}

		<input type="submit" value="Sauvegarder" class="bouton" data-couleur="secondaire">
	</form>
</main>

{{ include('layouts/pied.php') }}