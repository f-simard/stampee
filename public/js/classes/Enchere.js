class Enchere {
	#idEnchere;
	#btnFavori;
	#btnLord;

	constructor(idEnchere, elementHTML) {
		this.#idEnchere = idEnchere;
		this.#btnFavori = elementHTML.querySelector(".icone-favori");
		this.#btnLord = elementHTML.querySelector(".icone-lord");

		console.log(this.#btnLord);

		//ecouteur d'evenement
		this.#btnFavori.addEventListener(
			"click",
			this.#modifierFavori.bind(this)
		);

		this.#btnLord.addEventListener(
			"click",
			this.#modifierLord.bind(this)
		);
	}

	async #modifierFavori(evenement) {
		const bouton = evenement.currentTarget;
		const favori = bouton.dataset.favori;

		/*src: https://rapidapi.com/guides/query-parameters-fetch*/
		let data = new URLSearchParams();
		data.append("idEnchere", this.#idEnchere);

		if (favori == "true") {
			try {
				const reponse = await fetch(
					"http://localhost:8080/stampee/favori/supprimer",
					{
						method: "POST",
						body: data,
					}
				);
				bouton.dataset.favori = false;
				bouton.classList.remove("fa-solid");
				bouton.classList.add("fa-regular");
			} catch (erreur) {
				console.log(erreur);
			}
		} else {
			try {
				const reponse = await fetch(
					"http://localhost:8080/stampee/favori/creer",
					{
						method: "POST",
						body: data,
					}
				);
				bouton.dataset.favori = true;
				bouton.classList.remove("fa-regular");
				bouton.classList.add("fa-solid");
			} catch (erreur) {
				console.log(erreur);
			}
		}
	}

	async #modifierLord(evenement) {
		const bouton = evenement.currentTarget;
		const lord = bouton.dataset.lord;

		/*src: https://rapidapi.com/guides/query-parameters-fetch*/
		let data = new URLSearchParams();
		data.append("idEnchere", this.#idEnchere);

		if (lord == "true") {
			try {
				const reponse = await fetch(
					"http://localhost:8080/stampee/enchere/lord?retirer",
					{
						method: "POST",
						body: data,
					}
				);
				bouton.dataset.lord = false;
				bouton.classList.remove("fa-solid");
				bouton.classList.add("fa-regular");
			} catch (erreur) {
				console.log(erreur);
			}
		} else {
			try {
				const reponse = await fetch(
					"http://localhost:8080/stampee/enchere/lord?ajouter",
					{
						method: "POST",
						body: data,
					}
				);
				bouton.dataset.lord = true;
				bouton.classList.remove("fa-regular");
				bouton.classList.add("fa-solid");
			} catch (erreur) {
				console.log(erreur);
			}
		}
	}
}

export default Enchere;
