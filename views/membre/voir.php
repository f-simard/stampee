{{ include('layouts/entete.php' , {title: 'Voir membre'}) }}

<main>
	<section class="titre-paragraphe">
		<h2>Compte</h2>

		{% if membre.avatar is not empty %}
		<picture class="medaillon">
			<img src="{{upload}}{{membre.avatar}}" alt="avatar">
		</picture>
		{% endif %}

		<div class="champ-etiquette">
			<p class="etiquette">Prénom: </p>
			<p class="champ">{{membre.prenom}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="etiquette">Nom de famille: </p>
			<p class="champ">{{membre.nom}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="etiquette">Nom d'utilisateur: </p>
			<p class="champ">{{membre.nomUtilisateur}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="etiquette">Courriel: </p>
			<p class="champ">{{membre.courriel}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Adresse civique: </p>
			<p class="champ">{{membre.adresseCivique}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Code postal: </p>
			<p class="champ">{{membre.codePostal}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Ville: </p>
			<p class="champ">{{membre.ville}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Pays: </p>
			<p class="champ">{{pays}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Langue: </p>
			<p class="champ">{{langue}}</p>
		</div>

		<div class="champ-etiquette">
			<p class="adresseCivique">Devise: </p>
			<p class="champ">{{devise}}</p>
		</div>

	</section>
	<section class="actions">
		<a href="{{base}}/membre/timbre" class="bouton" data-couleur="secondaire">Voir mes timbres</a>
		<a href="{{base}}/timbre/creer" class="bouton" data-couleur="secondaire">Ajouter timbre</a>
		<a href="{{base}}/deconnexion" class="bouton" data-couleur="primaire">Déconnecter</a>
	</section>


</main>

{{ include('layouts/pied.php') }}