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
			<div class="choix-mode">
				<svg aria-label="icone liste" class="icone" data-mode="liste" data-ecran="tablette" data-format="mini" data-setCouleur="secondaireSurClair" data-selected="true" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<title>icone liste</title>
					<path d="M20.6686 8.16663V5.16663H43.6765V8.16663H20.6686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M20.6686 25.5V22.5H43.6765V25.5H20.6686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M20.6686 42.8333V39.8333H43.6765V42.8333H20.6686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M5.67651 8V5H6.25919V8H5.67651Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M5.67651 43V40H6.25919V43H5.67651Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M5.67651 25.6667V22.6667H6.25919V25.6667H5.67651Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<svg aria-label="icone grille" class="icone" data-format="mini" data-mode="grille" data-setCouleur="secondaireSurClair" data-ecran="tablette" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<title>icone grille</title>
					<path d="M8.40981 7.7371H5.67651V5H8.40981V7.7371Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M25.9896 25.3686H23.2563V22.6315H25.9896V25.3686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M8.40981 25.3686H5.67651V22.6315H8.40981V25.3686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M43.6767 7.7371H40.9434V5H43.6767V7.7371Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M25.9898 7.7371H23.2565V5H25.9898V7.7371Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M43.5695 25.3686H40.8362V22.6315H43.5695V25.3686Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M8.40981 42.9665H5.67651V40.2294H8.40981V42.9665Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M25.9896 43H23.2563V40.2629H25.9896V43Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M43.5695 43H40.8362V40.2629H43.5695V43Z" fill="#F7B02C" stroke="#F7B02C" stroke-width="10" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</div>
		</div>
		<div class="catalogue-conteneur liste" data-enchere="active">
			{% for enchere in encheres %}
			<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
				<article class="carte-lot" data-mode="liste" data-idenchere="{{enchere.idEnchere}}">
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
								<p data-enchere="estimation">{% if enchere.estimation == 0 %} N/A {% else %} {{enchere.devise}} {{enchere.estimation}} {% endif %}</p>
							</div>
							<div>
								<p>Mise courante {% if enchere.nbMise %} ({{enchere.nbMise}} mises) {% endif %}</p>
								<p data-enchere="miseCourante">{% if enchere.miseMax %}{{enchere.miseMax}} {% else %} Aucune mise {% endif %}</p>
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