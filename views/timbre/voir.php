{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>
	<section>
		<h2>Timbre {{timbre.idTimbre}}</h2>
	</section>
	<section class="details-timbre">
		<div>
			<div class="medias-timbre">
				<picture class="medias-timbre-principal agrandir">
					<img src="{{upload}}{{images|first}}" alt="image de timbre">
				</picture>
				<div class="medias-timbre-addionnels">
					{% for image in images|slice(1, 9) %}
					<picture>
						<img class="" src="{{upload}}{{image}}" alt="image de timbre">
					</picture>
					{% endfor %}
				</div>
			</div>
			<div class="info-timbre">
				<div>
					<h3>{{timbre.titre}}</h3>
					<p data-info="description">{{timbre.largeur}} x {{timbre.hauteur}}</p>
					<p>{{timbre.description}}</p>
				</div>
			</div>
			<div class="info-enchere">
				<div class="paire">
					<p>Pays d'origine</p>
					<p data-enchere="temps">{{pays.nom}}</p>
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
	</section>
</main>

{{ include('layouts/pied.php') }}