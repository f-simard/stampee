{{ include('layouts/entete.php' , {titre: 'Vitrine', 'navActive':'enchere'}) }}

<main>
	<h1>Vitrine</h1>
	<!-- <aside class="filtre">
		<div class="filtre__check">
			<input type="checkbox" id="filtre-bouton" aria-label="icone filtre en vue mobile">
		</div>
		<div class="filtre__contenu">
			<h4>Filtres</h4>
			<div class="filtre-recherche">
				<label for="recherche-filtre">Recherche</label>
				<div>
					<input type="text" name="recherche-filtre" id="recherche-filtre">
					<button class="bouton-reset">
						<picture class="icone bouton-reset" data-format="mini">
							<img src="assets/img/icones/loupe_noire.svg" alt="recherche">
						</picture>
					</button>
				</div>
			</div>
			<input type="checkbox" name="details-lord" id="details-lord" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-lord" class="details__label"><i class="fa-solid fa-award"></i>Coup de cœur du Lord</label>
				</summary>
				<div class="paire">
					<input type="checkbox" name="coeur-lord" id="coeur-lord">
					<label for="coeur-lord">Exclusivement</label>
				</div>
			</details>
			<input type="checkbox" name="details-prix" id="details-prix" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-prix" class="details__label">Prix</label>
				</summary>
				<div class="paire text">
					<label for="min">Minimum</label>
					<input type="text" name="min" id="min">
				</div>
				<div class="paire text">
					<label for="max">Maximum</label>
					<input type="text" name="max" id="max">
				</div>
			</details>
			<input type="checkbox" name="details-date" id="details-date" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-date" class="details__label">Date</label>
				</summary>
				<div class="paire text">
					<label for="debut">Début</label>
					<select name="debut" id="debut">
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="paire text">
					<label for="fin">Fin</label>
					<select name="fin" id="fin">
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
			</details>
			<input type="checkbox" name="details-pays" id="details-pays" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-pays" class="details__label">Pays</label>
				</summary>
				<div class="paire">
					<input type="checkbox" name="fr" id="fr">
					<label for="fr">France</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="DE" id="DE">
					<label for="DE">Allemagne</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="UK" id="UK">
					<label for="UK">Royaume-Uni</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="CA" id="CA">
					<label for="CA">Canada</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="US" id="US">
					<label for="US">États-Uni</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="AU" id="AU">
					<label for="AU">Australie</label>
				</div>
			</details>
			<input type="checkbox" name="details-conditions" id="details-conditions" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-conditions" class="details__label">Conditions</label>
				</summary>
				<div class="paire">
					<input type="checkbox" name="parfaite" id="parfaite">
					<label for="parfaite">Parfaite</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="execellente" id="excellente">
					<label for="excellente">Excellente</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="bonne" id="bonne">
					<label for="bonne">Bonne</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="moyenne" id="moyenne">
					<label for="moyenne">Moyenne</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="endommage" id="endommage">
					<label for="endommage">Endommagé</label>
				</div>
			</details>
			<input type="checkbox" name="details-certifie" id="details-certifie" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-certifie" class="details__label">Certifié</label>
				</summary>
				<div class="paire">
					<input type="radio" name="certification" id="certifie">
					<label for="certifie">Oui</label>
				</div>
				<div class="paire">
					<input type="radio" name="certification" id="nonCertifie">
					<label for="nonCertifie">Non</label>
				</div>
			</details>
			<button class="bouton" data-couleur="primaire-inverse">Réinitialiser</button>
			<button class="bouton" data-couleur="primaire">Appliquer</button>
		</div>
	</aside> -->
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
				<article class="carte-lot" data-mode="liste">
					<picture class="media-cadre">
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