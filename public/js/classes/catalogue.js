import Enchere from "./Enchere.js";

class Catalogue {
	static #instance;
	#checkboxFiltre;
	#filtres;
	#iconeMode;
	#formulaireFiltre;
	#btnAppliquerFiltre;
	#btnReinitialiser;
	#mode;
	#conteneurCatalogue;
	#champsAlphaNumDate;
	#champsCondition;
	#champsCertifie;
	#champsPays;
	#champLord;

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
		if (this.#iconeMode) {
			this.#iconeMode.addEventListener(
				"click",
				this.#changerMode.bind(this)
			);
		}

		// changer de mode pour les filtres
		this.#checkboxFiltre = document.querySelector("input#filtre-bouton");
		if (this.#checkboxFiltre) {
			this.#filtres = document.querySelector(".filtre");
		}

		// appliquer les filtres
		this.#formulaireFiltre = document.querySelector(".filtre__contenu");
		if (this.#formulaireFiltre) {
			this.#formulaireFiltre.addEventListener(
				"submit",
				function (evenement) {
					evenement.preventDefault();
				}.bind(this)
			);
		}

		this.#btnAppliquerFiltre = document.querySelector(
			"[data-action='appliquer']"
		);
		if (this.#btnAppliquerFiltre) {
			this.#btnAppliquerFiltre.addEventListener(
				"click",
				this.#AppliquerFiltre.bind(this)
			);
		}

		this.#btnReinitialiser = document.querySelector(
			"[data-action='reinitialiser']"
		);
		if (this.#btnReinitialiser) {
			this.#btnReinitialiser.addEventListener(
				"click",
				this.#reinitialiserFiltre.bind(this)
			);
		}

		//execution de code
		this.#instancierCarte();
		//ecouteur d'evenement
	}

	#instancierCarte() {
		const encheres = document.querySelectorAll(".js-enchere");

		encheres.forEach(function (enchere) {
			const idEnchere = enchere.dataset.idenchere;
			const e = new Enchere(idEnchere, enchere);
		});
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

	async #AppliquerFiltre(evenement) {
		evenement.preventDefault();

		this.#champsAlphaNumDate = this.#formulaireFiltre.querySelectorAll(
			".paire :is([type='text'], [type='number'], [type='date'])"
		);
		this.#champsPays = this.#formulaireFiltre.querySelectorAll(
			".paire [name='t|pays[]|I']"
		);
		this.#champsCertifie = this.#formulaireFiltre.querySelectorAll(
			".paire [name='t|certifie|E']"
		);
		this.#champsCondition = this.#formulaireFiltre.querySelectorAll(
			".paire [name='t|condition[]|I']"
		);
		this.#champLord = this.#formulaireFiltre.querySelectorAll(
			".paire [name='e|lord|E']"
		);

		const formData = new FormData();

		this.#champsAlphaNumDate.forEach(function (champ) {
			if (champ.value != "") {
				formData.append(champ.name, champ.value);
			}
		});

		let pays = [];
		this.#champsPays.forEach(function (champ) {
			if (champ.checked) {
				pays.push(champ.value);
			}
		});
		if (pays.length > 0) {
			formData.append("t|idPays|I", pays);
		}

		let conditions = [];
		this.#champsCondition.forEach(function (champ) {
			if (champ.checked) {
				conditions.push(champ.value);
			}
		});
		if (conditions.length > 0) {
			formData.append("t|idCondition|I", conditions);
		}

		let certifie;
		this.#champsCertifie.forEach(function (champ) {
			if (champ.checked) {
				certifie = champ.value;
			}
		});
		if (certifie != null) {
			formData.append("t|certifie|E", certifie);
		}

		let lord;
		this.#champLord.forEach(function (champ) {
			if (champ.checked) {
				lord = champ.value;
			}
		});
		if (lord == 1) {
			formData.append("e|lord|E", lord);
		}

		const queryString = new URLSearchParams(formData).toString();

		console.log(
			"http://localhost:8080/stampee/enchere/activeFiltre?" + queryString
		);

		try {
			const reponse = await fetch(
				"http://localhost:8080/stampee/enchere/activeFiltre?" +
					queryString
			);
			const data = await reponse.json();

			if ("msg" in data) {
				this.#conteneurCatalogue.innerHTML = "<h3>Aucune enchère</h3>";
			} else {
				this.#conteneurCatalogue.innerHTML = "";
				data.forEach((enchere) => {
					new Enchere(
						enchere.idEnchere,
						null,
						this.#conteneurCatalogue,
						enchere
					);
				});
			}
		} catch (erreur) {
			this.#conteneurCatalogue.innerHTML = "<h3 class='erreur'>Erreur</h3>";
			console.log(erreur);
		}
	}

	async #reinitialiserFiltre(evenement) {
		evenement.preventDefault();
		this.#formulaireFiltre.reset();

		try {
			const reponse = await fetch(
				"http://localhost:8080/stampee/enchere/activeFiltre"
			);
			const data = await reponse.json();

			this.#conteneurCatalogue.innerHTML = "";

			data.forEach((enchere) => {
				new Enchere(
					enchere.idEnchere,
					null,
					this.#conteneurCatalogue,
					enchere
				);
			});
		} catch (erreur) {
			console.log(erreur);
		}
	}
}

export default Catalogue;
