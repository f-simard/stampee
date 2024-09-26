{{ include('layouts/entete.php' , {titre: 'Mes mises'}) }}
<main>
	<section>

		<section class="titre-bouton">
			<h2>Mises personnelles</h2>
		</section>

		<div class="principal">
			<div class="grille">
				{% for mise in mises %}
				<article>
					<a href="{{base}}/enchere/voir?idEnchere={{mise.idEnchere}}">Enchere {{mise.idEnchere}} <i class="fa-solid fa-chevron-right"></i></a>
					<div class="paire">
						<p>Mise</p>
						<p>{{mise.idDevise}} {{mise.montant}}</p>
					</div>
					<div class="paire">
						<p>Date</p>
						<p>{{mise.date}}</p>
					</div>
				</article>
				{% endfor %}
			</div>
		</div>
	</section>
</main>

{{ include('layouts/pied.php') }}