{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>
	<section class="details-timbre">
		<div>
			<div class="medias-timbre">
				<picture class="medias-timbre-principal">
					<img class="" src="{{upload}}{{images|first}}" alt="image de timbre">
				</picture>
			</div>
			<div class="medias-timbre-addionnels">
				{% for image in images|slice(1, 9) %}
				<picture>
					<img class="" src="{{upload}}{{image}}" alt="image de timbre">
				</picture>
				{% endfor %}
			</div>
			<div class="info-timbre">
				<div>
					<header>
						<p>Timbre {{timbre.idTimbre}}</p>
					</header>
					<div>
						<h3>{{timbre.titre}}</h3>
						<p data-info="description">{{timbre.largeur}} x {{timbre.hauteur}}</p>
						<p>Année de production: <span>{{timbre.anneeProd}}</span></p>
						<p>{{timbre.description}}</p>
					</div>
				</div>
			</div>
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
	</section>
</main>

{{ include('layouts/pied.php') }}