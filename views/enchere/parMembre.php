{{ include('layouts/entete.php' , {titre: 'Base'}) }}
<main>
	<section>
		<h2>Enchères personnelless</h2>
		<div class="principal">
			<div class="catalogue-conteneur liste" data-enchere="active">
				{% for enchere in encheres %}
				<a href="details.html">
					<article class="carte-lot" data-mode="liste">
						<section class="info-lot">
							<div>
								<div class="info-lot__sous-entete">
									<h5>Enchere {{enchere.idEnchere}}</h5>
								</div>
							</div>
							<h5>Date debut: {{enchere.dateDebut}}</h5>
							<h5>Date fin: {{enchere.dateFin}}</h5>
							<h5>Prix plancher: {{enchere.prixPlancher}}</h5>
							<h5>Estimation: {{enchere.estimation}}</h5>
							<h5>Devise de base: {{enchere.idDevise}}</h5>
							<h5>Statut: {{enchere.statut}}</h5>
							<h5>Nombre de theme: {{enchere.nbTimbre}}</h5>
						</section>
					</article>
				</a>
				{% endfor %}
			</div>
		</div>
	</section>
</main>

{{ include('layouts/pied.php') }}