import CarteLot from "./CarteLot.js";

class Catalogue {
	static #instance;
	#checkboxFiltre;
	#filtres;
	#iconeMode;
	#iconeModeGrille;
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
		this.#iconeMode.addEventListener("click", this.#changerMode.bind(this));

		// changer de mode pour les filtres
		this.#checkboxFiltre = document.querySelector("input#filtre-bouton");
		this.#filtres = document.querySelector(".filtre");

		//ecouteur d'evenement
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

		let articles = this.#conteneurCatalogue.querySelectorAll(".carte-lot");

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
}

export default Catalogue;
