{{ include('layouts/entete.php' , {titre: 'Timbres personnels'}) }}
<main>
	<section>
		<section class="titre-bouton">
			<h2>Timbres personnels</h2>
		</section>
		<div class="principal">
			<div class="catalogue-conteneur liste" data-enchere="active">
				{% for timbre in timbres %}
				<a href="{{base}}/timbre/voir?idTimbre={{timbre.idTimbre}}">
					<article class="carte-lot" data-mode="liste">
						<picture class="media-cadre">
							<img src="{{upload}}{{timbre.imageSrc}}" alt="timbre">
						</picture>
						<div>
							<section class="info-lot">
								<div>
									<div class="info-lot__sous-entete">
										<h5 data-info="lot">Lot {{timbre.idTimbre}}</h5>
										{% if timbre.lord == 1 %}
										<i class="fa-solid fa-award fa-gl"></i>
										{% endif %}
									</div>
								</div>
								<h3 data-info="nom">{{timbre.titre}}</h3>
								<h5 data-info="date">{{timbre.anneeProd}}</h5>
								{% if timbre.description is not empty %}
								<p data-info="description">{{timbre.description}} <span class="lien">Plus d'information &#10095; </span></p>
								{% endif %}
								<h5>Enchere: {{timbre.statutEnchere}}</h5>
							</section>
						</div>
					</article>
				</a>
				{% endfor %}
			</div>
		</div>
	</section>
</main>
{{ include('layouts/pied.php') }}