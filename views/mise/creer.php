{{ include('layouts/entete.php' , {titre: 'Miser'}) }}

<main>
	<section>
		<h1>Placer une offre</h1>
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
					<p>Estimatio:</p>
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
					<p>TBD</p>
				</div>
				<div class="paire">
					<p>Mise courante:</p>
					<p>TBD</p>
				</div>
			</div>
		</section>
		<section>
			<h2>Mon offre</h2>
			<form method="post" novalidate>
				<div>
					<label for="montant">Mise*</label>
					<input type="number" name="montant" id="montant" min={{enchere.prixPlancer}}/>
					{% if erreurs.montant is defined %}
					<span class="erreur">{{erreurs.montant}}</span>
					{% endif %}
				</div>
			</form>
		</section>
	</section>
</main>

{{ include('layouts/pied.php') }}