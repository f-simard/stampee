import Enchere from "./Enchere.js";

class Catalogue {
	static #instance;
	#checkboxFiltre;
	#filtres;
	#iconeMode;
	#btnAppliquerFiltre;
	#boutonPassee;
	#boutonActive;
	#mode;
	#conteneurCatalogue;

	//Permet d'accéder à l'instance de la classe de n'importe où dans le code en utilisant App.instance
	static get instance() {
		return Catalogue.#instance;
	}

	constructor() {
		//singleton
		if (Catalogue.#instance) {
			return Catalogue.#instance;
		} else {
			Catalogue.#instance = this;
		}

		//element HTML et autres variabless
		this.#conteneurCatalogue = document.querySelector(
			".catalogue-conteneur"
		);
		this.#mode = "liste";

		//changer mode de vue (liste ou grille)
		this.#iconeMode = document.querySelector(".choix-mode");
		if (this.#iconeMode){
			this.#iconeMode.addEventListener(
				"click",
				this.#changerMode.bind(this)
			);
		}

		// changer de mode pour les filtres
		this.#checkboxFiltre = document.querySelector("input#filtre-bouton");
		if (this.#checkboxFiltre){
			this.#filtres = document.querySelector(".filtre");
		}


		// appliquer les filtres
		this.#btnAppliquerFiltre = document.querySelector(
			"[data-action='appliquer']"
		);
		if (this.#btnAppliquerFiltre){
			this.#btnAppliquerFiltre.addEventListener(
				"click",
				this.#AppliquerFiltre.bind(this)
			);
		}

		//execution de code
		this.#instancierCarte();
		//ecouteur d'evenement
	}

	#instancierCarte() {
		const encheres = document.querySelectorAll(".js-enchere");

		encheres.forEach(
			function (enchere) {
				const idEnchere = enchere.dataset.idenchere;
				const e = new Enchere(idEnchere, enchere);

				enchere.addEventListener(
					"click",
					this.#prevenirRedirection.bind(this)
				);
			}.bind(this)
		);
	}

	#prevenirRedirection(evenement) {
		if (
			evenement.target.classList.contains("icone-favori") ||
			evenement.target.classList.contains("icone-lord")
		) {
			evenement.preventDefault();
		}
	}

	#changerMode(evenement) {
		if (evenement) {
			this.#mode = evenement.target.closest("svg").dataset.mode;
		}

		if (this.#mode == "grille") {
			this.#conteneurCatalogue.classList.add("grille");
			this.#conteneurCatalogue.classList.remove("liste");
		} else if (this.#mode == "liste") {
			this.#conteneurCatalogue.classList.add("liste");
			this.#conteneurCatalogue.classList.remove("remove");
		}

		let articles = this.#conteneurCatalogue.querySelectorAll(".js-enchere");

		articles.forEach(
			function (article) {
				article.dataset.mode = this.#mode;
			}.bind(this)
		);
	}

	#affichageFiltre() {
		if (this.#checkboxFiltre.checked) {
			this.#filtres.dataset.ecran = "mobile";
		} else {
			this.#filtres.dataset.ecran = "bureau";
		}
	}

	async #AppliquerFiltre() {
		try {
			const reponse = await fetch(
				"http://localhost:8080/stampee/enchere/catalogue",
				{
					method: "POST",
				}
			);
			console.log("appliquer");
		} catch (erreur) {
			console.log(erreur);
		}
	}
}

export default Catalogue;
