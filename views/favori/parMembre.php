{{ include('layouts/entete.php' , {titre: 'Vitrine', 'navActive':'Favoris'}) }}

<main>
	<h1>Enchères Favories</h1>
	<div class="principal">
		<div class="tri-catalogue">
			<label for="tri">Tri</label>
			<select name="tri" id="tri">
				<option value="lot">Numéro de lot</option>
				<option value="courant-asc">Mise courante ascendante</option>
				<option value="courant-desc">Mise courante descendant</option>
				<option value="estimation-asc">Estimation ascendant</option>
				<option value="estimation-desc">Estimation descendant</option>
				<option value="depart-asc">Mise de départ ascendante</option>
				<option value="depart-desc">Mise de départ descendant</option>
			</select>
			<button class="bouton-reset">
				<picture>
					<img class="icone" data-format="mini" src="{{asset}}/img/icones/sort_noir.svg" alt="tri">
				</picture>
			</button>
		</div>
		<div class="catalogue-conteneur liste" data-enchere="active">
			{% for enchere in encheres %}
			<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
				<article class="carte-lot js-enchere" data-mode="liste" data-idenchere="{{enchere.idEnchere}}">
					<picture class=" media-cadre">
						<img src="{{upload}}{{enchere.chemin}}" alt="timbre">
					</picture>
					<div>
						<section class="info-lot">
							<div>
								<div class="info-lot__sous-entete">
									<h5 data-info="lot">Enchere {{ enchere.idEnchere }}</h5>
									{% if enchere.lord == 1 %}
									<i class="fa-solid fa-award fa-gl"></i>
									{% endif %}
								</div>
								<i class="icone-favori {% if enchere.estFavori is defined %}fa-solid {% else %}fa-regular {% endif %} fa-bookmark fa-lg"
									data-favori="{% if enchere.estFavori is defined %}true {% else %}false {% endif %}"></i>
							</div>
							<h3 data-info="nom">{% if enchere.nbTimbre > 1 %} Lot de plusieurs timbres ({{enchere.nbTimbre}}) {% else %} {{enchere.titre}} {% endif %}</h3>
							<h5 data-info="date">{{enchere.anneeProd}}</h5>
							<p data-info="description"><span class="lien">Plus d'information &#10095; </span>
							</p>
						</section>
						<div class="info-enchere">
							<div>
								<p>Temps restant</p>
								<p data-enchere="temps">XX</p>
							</div>
							<div>
								<p>Estimation</p>
								<p data-enchere="estimation">{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.idDevise}} {{enchere.estimation}} {% endif %}</p>
							</div>
							<div>
								<p>Mise courante {% if enchere.nbMise %} ({{enchere.nbMise}} mises) {% endif %}</p>
								<p data-enchere="miseCourante">{% if enchere.miseMax %}{{enchere.idDevise}}{{enchere.miseMax}} {% else %} Aucune mise {% endif %}</p>
							</div>
							<button class="bouton" data-couleur="secondaire">Miser</button>
						</div>
					</div>
				</article>
			</a>
			{% endfor %}
		</div>
	</div>
</main>
{{ include('layouts/pied.php') }}