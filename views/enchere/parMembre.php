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
			<div class="catalogue-conteneur grille">
				{% for enchere in encheres %}
				<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
					<article class="carte-lot" data-mode="grille">
						<section class="info-lot">
								<h5>Enchere {{enchere.idEnchere}}</h5>
							<div class="paire">
								<p>Date debut</p>
								<p>{{enchere.dateDebut}}</p>
							</div>
							<div class="paire">
								<p>Date fin</p>
								<p>{{enchere.dateFin}}</p>
							</div>
							<div class="paire">
								<p>Prix plancher</p>
								<p>{{enchere.prixPlancher}}</p>
							</div>
							<div class="paire">
								<p>Estimation</p>
								<p>{{enchere.estimation}}</p>
							</div>
							<div class="paire">
								<p>Devise de base</p>
								<p>{{enchere.idDevise}}</p>
							</div>
							<div class="paire">
								<p>Statut</p>
								<p>{{enchere.statut}}</p>
							</div>
							<div class="paire">
								<p>Nombre de timbre</p>
								<p>{{enchere.nbTimbre}}</p>
							</div>
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