class Enchere {
	#idEnchere;
	#btnFavori;
	#btnLord;

	constructor(idEnchere, elementHTML) {
		this.#idEnchere = idEnchere;
		this.#btnFavori = elementHTML.querySelector(".icone-favori");
		this.#btnLord;

		//ecouteur d'evenement
		this.#btnFavori.addEventListener(
			"click",
			this.#modifierFavori.bind(this)
		);
	}

	async #modifierFavori(evenement) {
		const bouton = evenement.currentTarget;
		const favori = bouton.dataset.favori

		this.#btnFavori.classList.toggle("fa-regular");
		this.#btnFavori.classList.toggle("fa-solid");

		if (favori == 'true') {
			bouton.dataset.favori = false;
			bouton.classList.remove('fa-solid');
			bouton.classList.add('fa-regular')
		} else {
			console.log('false');
			bouton.dataset.favori = true;
			bouton.classList.remove("fa-regular");
			bouton.classList.add("fa-solid");
		}


		// 	bouton.setAttribute("data-favori", "");
		// }

		// if (favori) {
		// 	const reponse = await fetch(
		// 		"http://localhost:8080/stampee/favori/supprimer"
		// 	);

		// 	delete bouton.dataset.favori;
		// } else {
		// 	const reponse = await fetch(
		// 		"http://localhost:8080/stampee/favori/creer"
		// 	);

		// 	bouton.setAttribute("data-favori", "");
		// }
	}
}

export default Enchere;
