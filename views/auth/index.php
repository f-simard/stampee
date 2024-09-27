{{ include('layouts/entete.php' , {titre: 'Connexion'}) }}

<main class="grille--2">
	<div class="section">
		<h2>Déja membre?</h2>
		<form class="formulaire formulaire_etroit" method="post" novalidate>

			{% if erreur.message is defined %}
			<span class="erreur">{{erreurs.message}}</span>
			{% endif %}
			{% if msg is defined %}
			<span class="success">{{msg}}</span>
			{% endif %}


			<label for="nomUtilisateur">Nom d'utilisateur</label>
			<input required type="text" name="nomUtilisateur" id="nomUtilisateur" value="{{membre.nomUtilisateur}}">
			{% if erreurs.nomUtilisateur is defined %}
			<span class="erreur">{{erreurs.nomUtilisateur}}</span>
			{% endif %}

			<label for="motDePasse">Mot de passe</label>
			<input required type="password" name="motDePasse" id="motDePasse" value="{{membre.motDePasse}}">
			{% if erreurs.motDePasse is defined %}
			<span class="erreur">{{erreurs.motDePasse}}</span>
			{% endif %}

			<input type="submit" value="Connecter" class="bouton" data-couleur="primaire">

		</form>
	</div>

	<div>
		<h2>Nouveau membre?</h2>
		<a href="{{base}}/membre/creer" class="bouton mt-broadest" data-couleur="primaire-inverse">Créer un compte</a>
</div>

</main>

{{ include('layouts/pied.php') }}