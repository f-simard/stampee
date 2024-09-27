{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main>

	<section class="timbre">
		<h2>Timbre {{timbre.idTimbre}}</h2>
		<div class="timbre__general">
			<h3>{{timbre.titre}}</h3>
			<p data-info="description">{{timbre.largeur}} x {{timbre.hauteur}}</p>
			<p>{{timbre.description}}</p>
		</div>
		<div class="timbre__details">
			<div class="paire">
				<p>Condition</p>
				<p data-enchere="temps">{{condition.nom}}</p>
			</div>
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
		<picture class="timbre__media--principal agrandir">
			<img src="{{upload}}{{images|first}}" alt="image de timbre">
		</picture>
		<div class="timbre__media--additionnels">
			{% for image in images|slice(1, 9) %}
			<picture>
				<img class="" src="{{upload}}{{image}}" alt="image de timbre">
			</picture>
			{% endfor %}
		</div>

	</section>
</main>

{{ include('layouts/pied.php') }}