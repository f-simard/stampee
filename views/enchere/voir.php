{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>
	<section class="details-timbre">
		<div>
			<div class="info-timbre">
				<div>
					<header>
						<p>Enchere {{enchere.idEnchere}}</p>
						{% if enchere.estFavori is defined %}
						<form action="{{base}}/favori/supprimer" method="post">
							<input type="submit" value="Retirer favori">
							<input type="hidden" name='idEnchere' value="{{enchere.idEnchere}}">
						</form>
						{% else %}
						<form action="{{base}}/favori/creer" method="post">
							<input type="submit" value="Ajouter favori">
							<input type="hidden" name='idEnchere' value="{{enchere.idEnchere}}">
						</form>
						{% endif %}
						<!-- <i class="icone-favori fa-regular fa-bookmark fa-lg"></i> -->
					</header>
					<div>
						<h3>{% if nbTimbre.compte > 1 %} Lot de plusieurs timbres ({{nbTimbre.compte}}) {% else %} {{timbres|first.titre}} {% endif %}</h3>
					</div>
				</div>
				<div class="info-timbre-enchere">
					<p>Estimation <span>{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.estimation}} {{enchere.devise}} {% endif %}</span></p>
					{% if enchere.statut != TERMINEE %}
					<p>Mise minimale: <span>{{enchere.idDevise}} {{enchere.prixPlancher}}</span></p>
					<p>Mise courante: <span>{{enchere.idDevise}}</span></p>
					{% if enchere.temps.avantDebut is defined %}
					<p>Début de l'enchère dans : <span>{{enchere.temps.avantDebut}}</span></p>
					{% endif %}
					{% if enchere.temps.avantFin is defined %}
					<p>Fin de l'enchère dans : <span>{{enchere.temps.avantFin}}</span></p>
					{% endif %}
					{% endif %}
				</div>
				<a href="{{base}}/mise/creer?idEnchere={{enchere.idEnchere}}" class="bouton" data-couleur="secondaire">MISER</a>
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