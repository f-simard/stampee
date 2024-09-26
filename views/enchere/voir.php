{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>
	<section class="details-timbre">
		<div>
			<div class="info-timbre">
				<div>
					<header class="js-enchere" data-idenchere="{{enchere.idEnchere}}">
						<p>Enchere {{enchere.idEnchere}}</p>
						<i class="icone-favori {% if enchere.estFavori is defined %}fa-solid {% else %}fa-regular {% endif %} fa-bookmark fa-lg"
							data-favori="{% if enchere.estFavori is defined %}true {% else %}false {% endif %}"></i>
					</header>
					<div>
						<h3>{% if nbTimbre.compte > 1 %} Lot de plusieurs timbres ({{nbTimbre.compte}}) {% else %} {{timbres|first.titre}} {% endif %}</h3>
						{% if enchere.lord == 1 %}
						<i class="fa-solid fa-award fa-gl"></i>
						{% endif %}
					</div>
				</div>
				<div class="info-timbre-enchere">
					<p>Estimation <span>{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.estimation}} {{enchere.devise}} {% endif %}</span></p>
					{% if enchere.statut != FERME %}
					<p>Mise minimale: <span>{{enchere.idDevise}} {{enchere.prixPlancher}}</span></p>
					<p>Mise courante: <span>{{enchere.idDevise}} {{enchere.misecourante}}</span></p>
					{% if enchere.temps.avantDebut is defined %}
					<p>Début de l'enchère dans : <span>{{enchere.temps.avantDebut}}</span></p>
					{% endif %}
					{% if enchere.temps.avantFin is defined %}
					<p>Fin de l'enchère dans : <span>{{enchere.temps.avantFin}}</span></p>
					{% endif %}
					{% endif %}
				</div>
				<a href="{{base}}/mise/creer?idEnchere={{enchere.idEnchere}}" class="bouton" data-couleur="secondaire">MISER</a>
				<i class="icone-membre fa-solid fa-user invisible"></i>
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
						<div class="paire">
							<p>Condition</p>
							<p data-enchere="temps">{{timbre.nomCondition}}</p>
						</div>
						<div class="paire">
							<p>Année de production</p>
							<p data-enchere="temps">{{timbre.anneeProd}}</p>
						</div>
						<div class="paire">
							<p>Tirage</p>
							<p data-enchere="temps">{{timbre.tirage}}</p>
						</div>
						<div class="paire">
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