{{ include('layouts/entete.php' , {titre: 'Details'}) }}
<main class="grille--2">
	<section class="enchere">
		<div class="titre-favori">
			<section>
				<h5>Enchere {{enchere.idEnchere}}</h5>
				{% if enchere.lord == 1 %}
				<i class="fa-solid fa-award fa-gl"></i>
				{% endif %}
			</section>
			<i class="icone-favori {% if enchere.estFavori is defined %}fa-solid {% else %}fa-regular {% endif %} fa-bookmark fa-lg"
				data-favori="{% if enchere.estFavori is defined %}true {% else %}false {% endif %}"></i>
		</div>
		<h3>{% if nbTimbre.compte > 1 %} Lot de plusieurs timbres ({{nbTimbre.compte}}) {% else %} {{timbres|first.titre}} {% endif %}</h3>
		<div>
			<div class="paire">
				<p>Estimation</p>
				<p>{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.estimation}} {{enchere.devise}} {% endif %}</p>
			</div>
			<div class="paire">
				<p>Mise minimale</p>
				<p>{{enchere.idDevise}} {{enchere.prixPlancher}}</p>
			</div>
			{% if enchere.statut != 'CREE' %}
			<div class="paire">
				{% if enchere.statut == 'OUVERT' %}
				<p>Mise courante</p>
				{% elseif enchere.statut == 'FERME' %}
				<p>Mise gagnante</p>
				{% endif %}
				<p>{{enchere.misecourante}}</p>
			</div>
			{% endif %}
			{% if enchere.temps.avantDebut is defined %}
			<div class="paire">
				<p>Temps avant enchère</p>
				<p>{{enchere.temps.avantDebut}}</p>
			</div>
			{% endif %}
			{% if enchere.temps.avantFin is defined %}
			<div class="paire">
				<p>Temps restant</p>
				<p>{{enchere.temps.avantFin}}</p>
			</div>
			{% endif %}
		</div>
		</div>
		<div class="bouton-icone">
			<a href="{{base}}/mise/creer?idEnchere={{enchere.idEnchere}}" class="bouton {% if session.idMembre == proprietaire.idMembre %}nonClickable{% endif %}"
				data-couleur="{% if session.idMembre == proprietaire.idMembre %}sombre{% else %}secondaire{% endif %}">MISER</a>
			<i class="icone-membre fa-solid fa-user {% if session.idMembre != proprietaire.idMembre %}invisible{% endif %}"></i>
		</div>
	</section>
	<div>
		<section class="titre-bouton">
			<h3>Timbres</h3>
		</section>
		<div class="catalogue-conteneur liste">
			{% for timbre in timbres %}
			<a href="{{base}}/timbre/voir?idTimbre={{timbre.idTimbre}}">
				<article class="carte-timbre">

					<picture>
						<img src="{{upload}}{{timbre.imageSrc}}" alt="timbre">
					</picture>
					<section class="carte-timbre__general">
						<h5>Timbre {{timbre.idTimbre}}</h5>
						<h3>{{timbre.titre}}</h3>
						<p>{{timbre.largeur}} x {{timbre.hauteur}}</p>
						<p>{{timbre.description}}</p>
					</section>
					<div class="carte-timbre__details">
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
				</article>
			</a>
			{% endfor %}
		</div>
	</div>
</main>

{{ include('layouts/pied.php') }}