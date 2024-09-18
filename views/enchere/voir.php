{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>
	<section class="details-timbre">
		<div>
			<div class="info-timbre">
				<div>
					<header>
						<p>Enchere {{enchere.idEnchere}}</p>
						<i class="icone-favori fa-regular fa-bookmark fa-lg"></i>
					</header>
					<div>
						<h3>{% if nbTimbre.compte > 1 %} Lot de plusieurs timbres ({{nbTimbre.compte}}) {% else %} {{timbres|first.titre}} {% endif %}</h3>
					</div>
				</div>
				<div class="info-timbre-enchere">
					<p>Estimation <span>{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.estimation}} {{enchere.devise}} {% endif %}</span></p>
					{% if enchere.statut ==  "CREE" %}
					<p>Mise minimale: <span>{{enchere.idDevise}} {{enchere.prixPlancher}}</span></p>
					{% else %}
					<p>Mise courante: <span>{{enchere.idDevise}}</span></p>
					{% endif %}
					<p>Temps restant: <span>XX</span></p>
				</div>
				<button class="bouton" data-couleur="secondaire">MISER</button>
			</div>
		</div>
	</section>
	<section class="titre-bouton">
		<h3>Timbres</h3>
	</section>
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
								<h5 data-info="lot">Timbre {{timbre.idTimbre}}</h5>
								{% if timbre.lord == 1 %}
								<i class="fa-solid fa-award fa-gl"></i>
								{% endif %}
							</div>
						</div>
						<h3 data-info="nom">{{timbre.titre}}</h3>
						<p data-info="description">{{timbre.largeur}} x {{timbre.hauteur}}</p>
						<p data-info="description">{{timbre.description}}</p>
					</section>
					<div class="info-enchere">
						<div>
							<p>Année de production</p>
							<p data-enchere="temps">{{timbre.anneeProd}}</p>
						</div>
						<div>
							<p>Tirage</p>
							<p data-enchere="temps">{{timbre.tirage}}</p>
						</div>
						<div>
							<p>Certifié</p>
							<p data-enchere="temps">{% if timbre.certifie == 1 %} Oui {% else %} Non {% endif %}</p>
						</div>
					</div>
				</div>
			</article>
		</a>
		{% endfor %}
	</div>
</main>

{{ include('layouts/pied.php') }}