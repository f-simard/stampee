{{ include('layouts/entete.php' , {titre: 'Accueil', 'navActive':'propos'}) }}
</header>
<div class="bouton-conteneur section">
	<button class="bouton" data-couleur="secondaire">Philatelie &#10097;</button>
	<button class="bouton" data-couleur="secondaire">Valeur &#10097;</button>
	<button class="bouton" data-couleur="secondaire">Bio &#10097;</button>
	<button class="bouton" data-couleur="secondaire">Equipe &#10097;</button>
</div>
<main class="m-auto">
	<section class="texte-image">
		<picture>
			<img src="{{asset}}/img/philatelie.jpg" alt="image pour philatelie">
		</picture>
		<section class="titre-paragraphe">
			<h3>Philatelie</h3>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos unde commodi laborum omnis debitis iure cum facere, repellendus consectetur ut! Labore earum dicta doloribus fugiat deleniti distinctio minus, repellat velit.</p>
			<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo quidem consequatur esse iste, modi suscipit odio unde porro aspernatur vero ad perferendis eius voluptatibus, ea odit impedit nesciunt molestiae corrupti!</p>
		</section>
	</section>
	<section class="section-centrale" data-bg="sombre--10">
		<h3>Valeur</h3>
		<p>Valeur 1 : Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi accusantium doloribus vero iste reiciendis velit consectetur quaerat!</p>
		<p>Valeur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint vero rerum impedit pariatur modi mollitia vitae soluta, dignissimos earum perferendis quae nam odit quis velit repellat.</p>
		<p>Valeur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, pariatur numquam ipsa mollitia deleniti ex minus rem corrupti veniam debitis nemo, architecto cupiditate aspernatur nostrum libero quos harum. Id ut esse temporibus?</p>
		<p>Valeur 4 : Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur dolores accusantium ratione. Distinctio voluptas rem dolorem facere eum quasi autem. Expedita corrupti vel minima nobis aspernatur adipisci!</p>
	</section>
	<section class="texte-image">
		<picture>
			<img src="{{asset}}/img/lord_stampee.jpg" alt="portrait Lord Stampee">
		</picture>
		<section class="titre-paragraphe">
			<h3>Biographie</h3>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos unde commodi laborum omnis debitis iure cum facere, repellendus consectetur ut! Labore earum dicta doloribus fugiat deleniti distinctio minus, repellat velit.</p>
			<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo quidem consequatur esse iste, modi suscipit odio unde porro aspernatur vero ad perferendis eius voluptatibus, ea odit impedit nesciunt molestiae corrupti!</p>
		</section>
	</section>
	<section class="boite-coin-arroundi" data-bg="sombre--10">
		<section class="titre-bouton">
			<h3>Equipe</h3>
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
		<section class="grille--2">
			<div class="carte-equipe">
				<picture>
					<img src="{{asset}}/img/portrait.jpg" alt="portait">
				</picture>
				<div class="texte-equipe">
					<h5>Directrice</h5>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos unde commodi laborum omnis debitis iure cum facere, repellendus consectetur ut! Labore earum dicta doloribus fugiat deleniti distinctio minus, repellat velit.</p>
				</div>
			</div>
			<div class="carte-equipe">
				<picture>
					<img src="{{asset}}/img/portrait.jpg" alt="portait">
				</picture>
				<div class="texte-equipe">
					<h5>Marketing et communication</h5>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos unde commodi laborum omnis debitis iure cum facere, repellendus consectetur ut!</p>
				</div>
			</div>
			<div class="carte-equipe">
				<picture>
					<img src="{{asset}}/img/portrait.jpg" alt="portait">
				</picture>
				<div class="texte-equipe">
					<h5>Service clientèle</h5>
					<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa, assumenda aspernatur quasi laboriosam, expedita labore asperiores voluptatem ipsum voluptate sequi, incidunt illum vel accusantium nam earum. Ut sequi ratione debitis vel sint amet esse deserunt ipsum possimus sed veniam minima eos quis eum, libero, eligendi omnis quos! Molestiae omnis beatae ipsum rem delectus sequi animi.</p>
				</div>
			</div>
			<div class="carte-equipe">
				<picture>
					<img src="{{asset}}/img/portrait.jpg" alt="portait">
				</picture>
				<div class="texte-equipe">
					<h5>Approvisionnement</h5>
					<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente veritatis officiis magni voluptas, quod aspernatur at atque rerum, quam hic blanditiis, repudiandae officia praesentium! Alias nesciunt, deserunt quos nam odit optio maiores pariatur ducimus, sapiente facilis quas aspernatur. Maiores, enim!</p>
				</div>
			</div>
		</section>
	</section>
</main>
{{ include('layouts/pied.php') }}