{{ include('layouts/entete.php' , {titre: 'Accueil'}) }}

<section class="banniere-large">
	<picture>
		<img src="{{asset}}/img/accueil.jpg" alt="pile de timbre">
	</picture>
	<section class="banniere-large texte-cta" data-taille="grand">
		<section class="titre-paragraphe">
			<h2>Bienvenu sur <i>Lord Stampee</i>, la première destination pour les collectionneurs et les amateurs de timbres-poste ! </h2>
		</section>
		<a href="connexion.html" class="bouton bouton-grand" data-couleur="secondaire">Créer un profile</a>
	</section>
</section>
<main class="m-auto">
	<section class="texte-image">
		<picture>
			<img src="{{asset}}/img/lord_stampee.jpg" alt="Lord Stampee">
		</picture>
		<section class="titre-paragraphe">
			<h3>Lord Stampee</h3>
			<p>Faites la connaissance de Lord Reginald Stampee III, l'éminent fondateur de site à son nom. Passionné d'histoire et de philatélie, Lord Harrison a consacré sa vie à la préservation et à l'appréciation des timbres du monde entier. Originaire de la pittoresque campagne anglaise, il organise depuis des années des ventes aux enchères exclusives de timbres dans son manoir ancestral, attirant des collectionneurs et des passionnés de tous horizons.</p>
			<!-- <p>Conscient de la possibilité de toucher un public plus large et de rassembler une communauté mondiale de personnes partageant les mêmes idées, Lord Harrison s'est lancé dans une nouvelle entreprise : la mise en ligne de ses célèbres ventes aux enchères. Cette décision a marqué le début de sa plateforme web, un site conçue pour offrir le même niveau de sophistication, de confiance et d'expertise qui a toujours été la marque de fabrique des ventes aux enchères de Lord Stampee.</p>
			<p>Avec sa plateforme en ligne, Lord Stampee poursuit son héritage en encourageant une communauté dynamique et engagée, où chaque collectionneur peut éprouver le plaisir de découvrir des timbres rares et uniques. Son engagement inébranlable en faveur de l'excellence et de l'innovation permet à [Nom du site web] de rester à la pointe du monde philatélique et d'offrir une expérience inégalée aux collectionneurs du monde entier.
			</p> -->
		</section>
	</section>
	<section class="boite-coin-arroundi" data-bg="sombre--10">
		<section class="titre-bouton">
			<div>
				<i class="fa-solid fa-award fa-2xl"></i>
				<h3>Coup de cœur du Lord</h3>
			</div>
			<button>
				<svg role="img" aria-label="icone plus" version="1.1" viewBox="0 0 24 24" fill="transparent" xmlns="http://www.w3.org/2000/svg">
					<title>icone pour plus d'info</title>
					<path stroke="none" d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17,14h-3v3c0,1.1-0.9,2-2,2s-2-0.9-2-2v-3H7   c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2h3V7c0-1.1,0.9-2,2-2s2,0.9,2,2v3h3c1.1,0,2,0.9,2,2C19,13.1,18.1,14,17,14z" id="add" />
				</svg>
			</button>
		</section>
		<div class="grille">
			{% if encheres!= 0 %}
			{% for enchere in encheres %}
			<a href="{{base}}/enchere/voir?idEnchere={{enchere.idEnchere}}">
				<article class="carte-coup-coeur">
					<picture>
						<img src="{{upload}}{{enchere.chemin}}" alt="timbre">
					</picture>
					<section>
						<h5>{{enchere.titre}}</h5>
						<dive class="paire">
							<p>Mise courante {% if enchere.nbMise %} ({{enchere.nbMise}} mises) {% endif %}</p>
							<p data-enchere="miseCourante">{% if enchere.miseMax %}{{enchere.idDevise}} {{enchere.miseMax}} {% else %} Aucune mise {% endif %}</p>
						</dive>
						<span class="lien">Plus d'information &#10095; </span>
					</section>
				</article>
			</a>
			{% endfor %}
			{% else %}
			<h3>Aucun coup de coeur en ce moment</h3>
			{% endif %}
		</div>
	</section>
	<section class="titre-bouton">
		<h3>Actualité</h3>
		<button>
			<svg version="1.1" viewBox="0 0 24 24"
				xmlns="http://www.w3.org/2000/svg"
				xmlns:xlink="http://www.w3.org/1999/xlink"
				role="img"
				aria-label="icone plus d'info">
				<title>Plus d'info</title>
				<path fill="#f7b02c" d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17,14h-3v3c0,1.1-0.9,2-2,2s-2-0.9-2-2v-3H7   c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2h3V7c0-1.1,0.9-2,2-2s2,0.9,2,2v3h3c1.1,0,2,0.9,2,2C19,13.1,18.1,14,17,14z" id="add" />
			</svg>
		</button>
	</section>
	<div class="carousel-container">
		<div class="carrousel-left">
			<i class="fa-solid fa-circle-play fa-flip-horizontal fa-2xl"></i>
			<!-- <picture><img src="assets/img/icones/carrousel-left.svg" alt="carrousel left icon"></picture> -->
		</div>
		<div class="carrousel-presentoir" data-carrousel="3">
			<article class="carte-actualite">
				<picture>
					<img src="{{asset}}/img/actualite/actu1.jpg" alt="actualité">
				</picture>
				<section>
					<h5>Titre actualité 1</h5>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id dignissimos exercitationem laudantium repudiandae quia iure nulla fugiat, obcaecati tempore vitae!
					</p>
					<a href="#" class="lien-details">Plus d'information &#10097;</a>
				</section>
			</article>
			<article class="carte-actualite">
				<picture>
					<img src="{{asset}}/img/actualite/actu2.jpg" alt="actualité">
				</picture>
				<section>
					<h5>Titre actualité 2</h5>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id dignissimos exercitationem laudantium repudiandae quia iure nulla fugiat, obcaecati tempore vitae! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae, cupiditate.
					</p>
					<a href="#" class="lien-details">Plus d'information &#10097;</a>
				</section>
			</article>
			<article class="carte-actualite">
				<picture>
					<img src="{{asset}}/img/actualite/actu3.jpg" alt="actualité">
				</picture>
				<section>
					<h5>Titre actualité 3</h5>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id dignissimos exercitationem laudantium repudiandae quia iure nulla fugiat, obcaecati tempore vitae!
					</p>
					<a href="#" class="lien-details">Plus d'information &#10097;</a>
				</section>
			</article>
		</div>
		<div class="carrousel-right">
			<i class="fa-solid fa-circle-play fa-2xl"></i>
			<!-- <picture><img src="assets/img/icones/carrousel-right.svg" alt="carrousel right icon"></picture> -->
		</div>
	</div>
	<div>
		<div class="carrousel-items">
			<picture><img src="{{asset}}/img/icones/circle-jaune.svg" alt="carousel item"></picture>
			<picture><img src="{{asset}}/img/icones/circle-blank.svg" alt="carousel item"></picture>
			<picture><img src="{{asset}}/img/icones/circle-blank.svg" alt="carousel item"></picture>
		</div>
	</div>
	</section>
</main>

{{ include('layouts/pied.php') }}