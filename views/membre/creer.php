{{ include('layouts/entete.php' , {title: 'Créer membre'}) }}

<main class="w-auto">
	<h2>Créer un compte</h2>
	<form class="formulaire" method="post" enctype="multipart/form-data" novalidate>

		<div>
			<label for="fichierATeleverser">Ajouter un avatar: </label>
			<input type="file" name="fichierATeleverser" id="fichierATeleverser" />
			{% if erreurs.fichierATeleverser is defined %}
			<span class="erreur">{{erreurs.fichierATeleverser}}</span>
			{% endif %}
		</div>

		<div>
			<label for="prenom">Prénom *</label>
			<input type="text" name="prenom" id="prenom" value="{{membre.prenom}}">
			{% if erreurs.prenom is defined %}
			<span class="erreur">{{erreurs.prenom}}</span>
			{% endif %}
		</div>

		<div>
			<label for="nom">Nom de famille *</label>
			<input type="text" name="nom" id="nom" value="{{membre.nom}}">
			{% if erreurs.nom is defined %}
			<span class="erreur">{{erreurs.nom}}</span>
			{% endif %}
		</div>

		<div>
			<label for="nomUtilisateur">Nom d'utilisateur *</label>
			<input type="text" name="nomUtilisateur" id="nomUtilisateur" value="{{membre.nomUtilisateur}}">
			{% if erreurs.nomUtilisateur is defined %}
			<span class="erreur">{{erreurs.nomUtilisateur}}</span>
			{% endif %}
		</div>

		<div>
			<label for="courriel">Courriel *</label>
			<input type="email" name="courriel" id="courriel" value="{{membre.courriel}}">
			{% if erreurs.courriel is defined %}
			<span class="erreur">{{erreurs.courriel}}</span>
			{% endif %}
		</div>

		<div>
			<label for="motDePasse">Mot de passe *</label>
			<input type="password" name="motDePasse" id="motDePasse" value="{{membre.motDePasse}}">
			{% if erreurs.motDePasse is defined %}
			<span class="erreur">{{erreurs.motDePasse}}</span>
			{% endif %}
		</div>

		<div>
			<label for="adresseCivique">Adresse Civique</label>
			<input type="text" name="adresseCivique" id="adresseCivique" value="{{membre.adresseCivique}}">
			{% if erreurs.adresseCivique is defined %}
			<span class="erreur">{{erreurs.adresseCivique}}</span>
			{% endif %}
		</div>

		<div>
			<label for="codePostal">Code postal (A1A 1A1)</label>
			<input type="text" name="codePostal" id="codePostal" value="{{membre.codePostal}}">
			{% if erreurs.codePostal is defined %}
			<span class="erreur">{{erreurs.codePostal}}</span>
			{% endif %}
		</div>

		<div>
			<label for="ville">Ville</label>
			<input type="text" name="ville" id="ville" value="{{membre.ville}}">
			{% if erreurs.ville is defined %}
			<span class="erreur">{{erreurs.ville}}</span>
			{% endif %}
		</div>

		<div>
			<label for="idPays">Pays *</label>
			<select name="idPays" id="idPays">
				<option value="">Sélectionner un pays</option>
				{% for pays in pays_liste %}
				<option value="{{pays.idPays}}" {% if pays.idPays == membre.idPays %} selected {% endif %}>{{pays.nom}}</option>
				{% endfor  %}
			</select>
			{% if erreurs.pays is defined %}
			<span class="erreur">{{erreurs.pays}}</span>
			{% endif %}
		</div>

		<div>
			<label for="idLangue">Langue *</label>
			<select name="idLangue" id="idLangue">
				<option value="">Sélectionner une langue</option>
				{% for langue in langues %}
				<option value="{{langue.idLangue}}" {% if langue.idLangue == membre.idlangue %} selected {% endif %}> {{langue.idLangue}} - {{langue.nom}}</option>
				{% endfor %}
			</select>
			{% if erreurs.langue is defined %}
			<span class="erreur">{{erreurs.langue}}</span>
			{% endif %}
		</div>

		<div>
			<label for="idDevise">Devise *</label>
			<select name="idDevise" id="idDevise">
				<option value="">Sélectionner une devise</option>
				{% for devise in devises %}
				<option value="{{devise.idDevise}}" {% if devise.idDevise == membre.idDevise %} selected {% endif %}>{{devise.idDevise}} - {{devise.nom}}</option>
				{% endfor %}
			</select>
			{% if erreurs.devise is defined %}
			<span class="erreur">{{erreurs.devise}}</span>
			{% endif %}
		</div>


		<input type="submit" value="Sauvegarder" class="bouton" data-couleur="secondaire">
	</form>
</main>

{{ include('layouts/pied.php') }}