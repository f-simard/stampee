{{ include('layouts/entete.php' , {titre: 'Vitrine', 'navActive':'enchere'}) }}

<main>
	<h1>Vitrine</h1>
	<div class="bouton-container section">
		<a href="{{base}}/enchere/catalogue" class="bouton" data-couleur="sombre" data-enchere="active" data-selected="true">Encheres actives</a>
		<a href="{{base}}/enchere/archive" class="bouton" data-couleur="sombre" data-enchere="passee" data-selected="false">Enchere passées</a>
	</div>
	<aside class="filtre">
		<div class="filtre__check">
			<input type="checkbox" id="filtre-bouton" aria-label="icone filtre en vue mobile">
		</div>
		<form method='get' class="filtre__contenu">
			<h4>Filtres</h4>
			<!-- <div class="filtre-recherche">
				<label for="recherche-filtre">Recherche</label>
				<div>
					<input type="text" name="recherche-filtre" id="recherche-filtre">
					<button class="bouton-reset">
						<picture class="icone bouton-reset" data-format="mini">
							<img src="{{asset}}/img/icones/loupe_noire.svg" alt="recherche">
						</picture>
					</button>
				</div>
			</div> -->
			<input type="checkbox" name="details-lord" id="details-lord" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-lord" class="details__label"><i class="fa-solid fa-award"></i>Coup de cœur du Lord</label>
				</summary>
				<div class="paire">
					<input type="checkbox" name="e|lord|E" id="enchere|lord" value="1">
					<label for="enchere|lord">Exclusivement</label>
				</div>
			</details>
			<input type="checkbox" name="details-prix" id="details-prix" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-prix" class="details__label">Prix</label>
				</summary>
				<div class="paire text">
					<label for="mise|min">Minimum</label>
					<input type="number" name="|misecourante|PGE" id="mise|min" min=0>
				</div>
				<div class="paire text">
					<label for="mise|max">Maximum</label>
					<input type="number" name="|misecourante|PPE" id="mise|max" min=0>
				</div>
			</details>
			<input type="checkbox" name="details-date" id="details-date" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-date" class="details__label">Date</label>
				</summary>
				<div class="paire text">
					<label for="debut">Début</label>
					<input type="date" name="e|dateDebut|PGE" id="debut" min={{aujourdhui}}>
				</div>
				<div class="paire text">
					<label for="fin">Fin</label>
					<input type="date" name="e|dateFin|PPE" id="fin" min={{aujourdhui}}>
				</div>
			</details>
			<input type="checkbox" name="details-pays" id="details-pays" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-pays" class="details__label">Pays</label>
				</summary>
				{% for pays in pays_liste %}
				<div class="paire">
					<input type="checkbox" name="t|pays[]|I" id="{{pays.idPays}}" value="{{pays.idPays}}">
					<label for="{{pays.idPays}}">{{pays.nom}}</label>
				</div>
				{% endfor %}
			</details>
			<input type="checkbox" name="details-conditions" id="details-conditions" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-conditions" class="details__label">Conditions</label>
				</summary>
				{% for condition in conditions %}
				<div class="paire">
					<input type="checkbox" name="t|condition[]|I" id="{{condition.idCondition}}" value="{{condition.idCondition}}">
					<label for="{{condition.idCondition}}">{{condition.nom}}</label>
				</div>
				{% endfor %}
			</details>
			<input type="checkbox" name="details-certifie" id="details-certifie" class="details__checkbox">
			<details open>
				<summary>
					<label for="details-certifie" class="details__label">Certifié</label>
				</summary>
				<div class="paire">
					<input type="radio" name="t|certifie|E" id="certifie" value="1">
					<label for="certifie">Oui</label>
				</div>
				<div class="paire">
					<input type="radio" name="t|certifie|E" id="nonCertifie" value="0">
					<label for="nonCertifie">Non</label>
				</div>
			</details>
			<button class="bouton" data-couleur="primaire-inverse" data-action="reinitialiser">Réinitialiser</button>
			<button class="bouton" data-couleur="primaire" data-action="appliquer">Appliquer</button>
		</form>
	</aside>
	<div class="principal">
		<div class="tri-catalogue">
			<label for="tri">Tri</label>
			<select name="tri" id="tri">
				<option value="e|idEnchere|ASC" selected>Numéro de lot</option>
				<option value="m|misecourante|ASC">Mise courante croissante</option>
				<option value="m|misecourante|DESC">Mise courante décroissante</option>
				<option value="e|estimation|ASC">Estimation croissante</option>
				<option value="e|estimation|DESC">Estimation décroissate</option>
				<option value="e|prixPlancher|ASC">Mise de départ croissante</option>
				<option value="e|prixPlancher|DESC">Mise de départ décroissante</option>
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
		<div class="catalogue-conteneur liste js-catalogue" data-enchere="active">
		</div>
	</div>
	<template class="js-template-enchere">
		<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
			<article class="carte-lot js-enchere" data-mode="liste" data-idenchere="">
				<i class="icone-lord fa-star" data-lord="">Lord</i>
				<picture class="media-cadre">
					<img src="" alt="timbre">
				</picture>
				<div>
					<section class="info-lot">
						<div>
							<div class="info-lot__sous-entete">
								<h5 data-info="lot">Enchere <span data-render="idEnchere"></span></h5>
								<i class="fa-solid fa-award fa-gl"></i>
							</div>
							<i class="icone-favori fa-bookmark fa-lg"
								data-favori=""></i>
						</div>
						<h3 data-info="nom" data-render="titre">{{titre}}</h3>
						<h5 data-info="date" data-render="anneeProd">{{anneeProd}}</h5>
						<p data-info="description"><span class="lien">Plus d'information &#10095; </span>
						</p>
					</section>
					<div class="info-enchere">
						<div class="js-temp">
							<p data-render="tempEtiquette">Temps etiquette</p>
							<p data-enchere="temps" data-render="temps">temps Enchere</p>
						</div>
						<div>
							<p>Estimation</p>
							<p data-enchere="estimation" data-render="estimation">{{estimation}}</p>
						</div>
						<div>
							<p>Mise courante <span data-render="nbMise">{{nbMise}}</span></p>
							<p data-enchere="miseCourante" data-render="miseCourante">{{miseCourante}}</p>
						</div>
						<button class="bouton" data-couleur="">Miser</button>
						<i class="icone-membre fa-solid fa-user invisible"></i>
					</div>
				</div>
			</article>
		</a>
	</template>
</main>
{{ include('layouts/pied.php') }}