{{ include('layouts/entete.php' , {titre: 'Base'}) }}
<main>
	<section>
		{% if succes is not null %}
		<span class="succes">{{succes}}</span>
		{% endif %}

		<section class="titre-bouton">
			<h2>Enchères personnelles</h2>
		</section>

		<div class="principal">
			<div class="catalogue-conteneur liste" data-enchere="active">
				{% for enchere in encheres %}
				<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
					<article class="carte-lot" data-mode="liste">
						<section class="info-lot">
							<h5>Enchere {{enchere.idEnchere}}</h5>
							<p>Date debut: {{enchere.dateDebut}}</p>
							<p>Date fin: {{enchere.dateFin}}</p>
							<p>Prix plancher: {{enchere.prixPlancher}}</p>
							<p>Estimation: {{enchere.estimation}}</p>
							<p>Devise de base: {{enchere.idDevise}}</p>
							<p>Statut: {{enchere.statut}}</p>
							<p>Nombre de timbre: {{enchere.nbTimbre}}</p>
						</section>
						<form action="{{base}}/enchere/supprimer" method="post">
							<input type="hidden" name="idEnchere" value="{{enchere.idEnchere}}">
							<button class="bouton">Supprimer</button>
						</form>
					</article>
				</a>
				{% endfor %}
			</div>
		</div>
	</section>
</main>

{{ include('layouts/pied.php') }}