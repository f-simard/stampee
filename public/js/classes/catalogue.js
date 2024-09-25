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
	#enchereStatut;
	#conteneurCatalogue;
	#champsAlphaNumDate;
	#champsCondition;
	#champsCertifie;
	#champsPays;
	#champLord;
	#listeEnchere;
	#optionsTriHTML;
	#choixTriHTML;
	#choixTri;

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
		this.#conteneurCatalogue = document.querySelector(".js-catalogue");
		if (this.#conteneurCatalogue) {
			this.#enchereStatut = this.#conteneurCatalogue.dataset.enchere;
		}
		this.#mode = "liste";
		this.#listeEnchere = [];
		this.#choixTri = document.querySelector("option[selected]").value;

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
				this.#appliquerFiltre.bind(this)
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

		this.#choixTriHTML = document.querySelector("select[name='tri']");
		this.#choixTriHTML.addEventListener(
			"change",
			this.#choisirTri.bind(this)
		);

		this.#optionsTriHTML = document.querySelectorAll(
			"select[name='tri'] > option"
		);
		this.#optionsTriHTML.forEach(
			function (option) {
				option.addEventListener("click", this.#choisirTri.bind(this));
			}.bind(this)
		);

		//execution de code
		if (this.#conteneurCatalogue) {
			this.#instancierEnchere();
		}
	}

	async #instancierEnchere() {
		if (document.querySelector(".details-timbre")) {
			const elementHTML = document.querySelector(".details-timbre");
			new Enchere(elementHTML);
		} else {
			try {
				let reponse;
				let data;
				if (this.#enchereStatut == "active") {
					const reponse = await fetch(
						"http://localhost:8080/stampee/enchere/activeFiltre"
					);
					data = await reponse.json();
				} else if (this.#enchereStatut == "archive") {
					reponse = await fetch(
						"http://localhost:8080/stampee/enchere/archiveFiltre"
					);
					data = await reponse.json();
				}

				let encheresTriees = this.#trier(data, this.#choixTri);

				if (data.hasOwnProperty("msg")) {
					this.#conteneurCatalogue.innerHTML =
						"<h3>Aucune enchère</h3>";
				} else {
					this.#conteneurCatalogue.innerHTML = "";
					encheresTriees.forEach((enchere) => {
						const e = new Enchere(
							null,
							this.#conteneurCatalogue,
							enchere
						);
						this.#listeEnchere.push(e);
					});
				}
			} catch (erreur) {
				this.#conteneurCatalogue.innerHTML =
					"<h3 class='erreur'>Erreur</h3>";
				console.warn(erreur);
			}
		}
	}

	#choisirTri(evenement) {
		const cible = evenement.target.selectedOptions[0];
		this.#choixTri = cible.value;

		this.#optionsTriHTML.forEach(
			function (option) {
				if (option.value == this.#choixTri) {
					option.setAttribute("selected", "");
				} else {
					option.removeAttribute("selected");
				}
			}.bind(this)
		);

		this.#appliquerFiltre(null);
	}

	#trier(data, tri) {
		let copie = data;
		let encheresTriees;
		let optionTri = tri.split("|");
		const table = optionTri[0];
		const colonne = optionTri[1];
		const ordre = optionTri[2];
		switch (ordre) {
			case "ASC":
				encheresTriees = copie.sort((a, b) => {
					if (a[colonne] < b[colonne]) {
						return -1;
					} else if (a[colonne] > b[colonne]) {
						return 1;
					}
					return 0; // They are equal
				});
				break;
			case "DESC":
				encheresTriees = copie.sort((a, b) => {
					if (a[colonne] < b[colonne]) {
						return 1;
					} else if (a[colonne] > b[colonne]) {
						return -1;
					}
					return 0; // They are equal
				});
				break;
		}

		return encheresTriees;
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

	#parseFiltre() {
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

		return queryString;
	}

	async #appliquerFiltre(evenement) {
		if (evenement != null) {
			evenement.preventDefault();
		}
		const queryString = this.#parseFiltre();

		try {
			let reponse;
			let data;
			if (this.#enchereStatut == "active") {
				const reponse = await fetch(
					"http://localhost:8080/stampee/enchere/activeFiltre?" +
						queryString
				);
				data = await reponse.json();
			} else if (this.#enchereStatut == "archive") {
				reponse = await fetch(
					"http://localhost:8080/stampee/enchere/archiveFiltre?" +
						queryString
				);
				data = await reponse.json();
			}

			if (data.hasOwnProperty("msg")) {
				this.#conteneurCatalogue.innerHTML = "<h3>Aucune enchère</h3>";
			} else {
				this.#conteneurCatalogue.innerHTML = "";
				let encheresTriees = this.#trier(data, this.#choixTri);
				encheresTriees.forEach((enchere) => {
					const e = new Enchere(
						null,
						this.#conteneurCatalogue,
						enchere
					);
					this.#listeEnchere.push(e);
				});
			}
		} catch (erreur) {
			this.#conteneurCatalogue.innerHTML =
				"<h3 class='erreur'>Erreur</h3>";
			console.warn(erreur);
		}
	}

	async #reinitialiserFiltre(evenement) {
		evenement.preventDefault();
		this.#formulaireFiltre.reset();

		try {
			let reponse;
			let data;

			if (this.#enchereStatut == "active") {
				const reponse = await fetch(
					"http://localhost:8080/stampee/enchere/activeFiltre?"
				);
				data = await reponse.json();
			} else if (this.#enchereStatut == "archive") {
				reponse = await fetch(
					"http://localhost:8080/stampee/enchere/archiveFiltre?"
				);
				data = await reponse.json();
			}

			if (data.hasOwnProperty("msg")) {
				this.#conteneurCatalogue.innerHTML = "<h3>Aucune enchère</h3>";
			} else {
				this.#conteneurCatalogue.innerHTML = "";
				let encheresTriees = this.#trier(data, this.#choixTri);
				encheresTriees.forEach((enchere) => {
					const e = new Enchere(
						null,
						this.#conteneurCatalogue,
						enchere
					);
					this.#listeEnchere.push(e);
				});
			}
		} catch (erreur) {
			this.#conteneurCatalogue.innerHTML =
				"<h3 class='erreur'>Erreur</h3>";
			console.warn(erreur);
		}
	}
}

export default Catalogue;
