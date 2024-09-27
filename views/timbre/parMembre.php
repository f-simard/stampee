{{ include('layouts/entete.php' , {titre: 'Timbres personnels'}) }}
<main>
	<section>
		<section class="titre-bouton">
			<h2>Timbres personnels</h2>
		</section>
		<div class="principal">
			<div class="grille">
				{% for timbre in timbres %}
				<a href="{{base}}/timbre/voir?idTimbre={{timbre.idTimbre}}">
					<article class="carte-resume" data-mode="liste">
						<picture>
							<img src="{{upload}}{{timbre.imageSrc}}" alt="timbre">
						</picture>
						<section>
							<h5>Timbre {{timbre.idTimbre}}</h5>
							{% if timbre.lord == 1 %}
							<i class="fa-solid fa-award fa-gl"></i>
							{% endif %}
							<h3 class=".carte-resume__titre--grand">{{timbre.titre}}</h3>
							<h5>{{timbre.anneeProd}}</h5>
							{% if timbre.description is not empty %}
							<p class="mt-thinnest">{{timbre.description}}</p>
								{% endif %}
								<h5 class="mt-thinner">Enchere: {{timbre.statutEnchere}}</h5>
						</section>
					</article>
				</a>
				{% endfor %}
			</div>
		</div>
	</section>
</main>
{{ include('layouts/pied.php') }}