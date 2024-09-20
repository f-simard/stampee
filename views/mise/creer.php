{{ include('layouts/entete.php' , {titre: 'Miser'}) }}

<main>
	<section>
		<h1>Placer une offre</h1>
	</section>
	<div class="grille grille--2">
		<section>
			<h2>Info enchère</h2>
			<div>
				<div class="paire">
					<p>Date de début:</p>
					<p>{{enchere.dateDebut}}</p>
				</div>
				<div class="paire">
					<p>Date de fin:</p>
					<p>{{enchere.dateFin}}</p>
				</div>
				<div class="paire">
					<p>Estimation:</p>
					<p>{{enchere.estimation}}</p>
				</div>
				<div class="paire">
					<p>Mise minimum:</p>
					<p>{{enchere.prixPlancher}}</p>
				</div>
				<div class="paire">
					<p>Coup coeur du lord:</p>
					<p>{% if enchere.lord == 1 %} Oui {% else %} Non {% endif %}</p>
				</div>
				<div class="paire">
					<p>Nombre de mise:</p>
					<p>{% if miseCompte.compte %} {{miseCompte.compte}} {% else %} Aucune mise {% endif %}</p>
				</div>
				<div class="paire">
					<p>Mise courante:</p>
					<p>{% if miseMax.montant %} {{miseMax.montant}} {% else %} Aucune mise {% endif %}</p>
				</div>
			</div>
		</section>
		<section>
			<h2>Mon offre</h2>
			<form method="post" novalidate>
				<div>
					<div>
						<label for="idDevise">Devise *</label>
						<select name="idDevise" id="idDevise" disabled>
							<option value="">Sélectionner une devise</option>
							{% for devise in devises %}
							<option value="{{devise.idDevise}}" {% if devise.idDevise == enchere.idDevise %} selected {% endif %}>{{devise.idDevise}}</option>
							{% endfor %}
						</select>
						{% if erreurs.devise is defined %}
						<span class="erreur">{{erreurs.devise}}</span>
						{% endif %}
					</div>
					<label for="montant">Mise*</label>
					<input type="hidden" name="idEnchere" value="{{enchere.idEnchere}}">
					<input type="number" name="montant" id="montant" min={{enchere.prixPlancher}} />
					{% if erreurs.montant is defined %}
					<span class="erreur">{{erreurs.montant}}</span>
					{% endif %}
					<input type="submit" value="Miser" class="bouton" data-couleur="secondaire">
				</div>
			</form>
		</section>
	</div>
	</section>
</main>

{{ include('layouts/pied.php') }}