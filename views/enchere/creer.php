{{ include('layouts/entete.php' , {title: 'Créer enchere'}) }}

<main class="w-auto">
	<h2>Ajouter enchère</h2>
	<form class="formulaire" method="post" novalidate>

		<div>
			<label for="dateDebut">Date de début *</label>
			<input type="date" name="dateDebut" id="dateDebut" value="{{enchere.dateDebut}}">
			{% if erreurs.dateDebut is defined %}
			<span class="erreur">{{erreurs.dateDebut}}</span>
			{% endif %}
		</div>

		<div>
			<label for="dateFin">Date de fin *</label>
			<input type="date" name="dateFin" id="dateFin" value="{{enchere.dateFin}}">
			{% if erreurs.dateFin is defined %}
			<span class="erreur">{{erreurs.dateFin}}</span>
			{% endif %}
		</div>

		<div>
			<label for="prixPlancher">Prix plancher *</label>
			<input required type="number" name="prixPlancher" id="prixPlancher" value="{{enchere.prixPlancher}}">
			{% if erreurs.prixPlancher is defined %}
			<span class="erreur">{{erreurs.prixPlancher}}</span>
			{% endif %}
		</div>

		<div>
			<label for="estimation">Estimation</label>
			<input required type="number" name="estimation" id="estimation" value="{{enchere.estimation}}" min=0>
			{% if erreurs.estimation is defined %}
			<span class="erreur">{{erreurs.estimation}}</span>
			{% endif %}
		</div>

		<fieldset>
			<legend>Timbres à mettre en enchère</legend>
			{% if timbres %}
			{% for timbre in timbres %}
			<div>
				<!-- sourceTwig: https://dev.to/yanyy/string-concatenation-and-interpolation-in-twig-3h2f AND chatGTP-->
				<!-- sourceHTML: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/checkbox-->
				<!-- sourceHTML: https://www.hashbangcode.com/article/html-checkbox-php-array -->
				{% set idTimbre = "timbre" ~ timbre.idTimbre %}
				<input type="checkbox" name="timbres[]" id="timbre{{timbre.idTimbre}}" value="{{timbre.idTimbre}}" {% if timbre.idTimbre in enchere.timbres %} checked {% endif %}>
				<label id="timbre{{timbre.idTimbre}}">{{timbre.titre}} </label>
			</div>
			{% endfor %}
			{% else %}
			<p>Aucun timbre disponible</p>
			{% endif %}
			{% if erreurs.timbres is defined %}
			<span class="erreur">{{erreurs.timbres}}</span>
			{% endif %}
		</fieldset>

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