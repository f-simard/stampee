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
		const favori = bouton.dataset.favori;

		const data = new URLSearchParams();
		data.append("idEnchere", this.#idEnchere);

		console.log(data.toString());

		if (favori == "true") {
			try {
				const reponse = await fetch(
					"http://localhost:8080/stampee/favori/supprimer",
					{
						method: "POST",
						body: data,
					}
				);

				console.log(reponse.text());

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

				console.log(reponse.text());
				bouton.dataset.favori = true;
				bouton.classList.remove("fa-regular");
				bouton.classList.add("fa-solid");
			} catch (erreur) {
				console.log(erreur);
			}
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
