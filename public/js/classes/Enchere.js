import Site from "./Site.js";

class Enchere {
	#idEnchere;
	#btnFavori;
	#btnLord;
	#conteneurHTML;
	#elementHTML;
	#template;
	#dateDebut;
	#dateFin;
	#prixPlancher;
	#estimation;
	#idDevise;
	#statut;
	#lord;
	#estFavori;
	#nbTimbre;
	#idTimbre;
	#titre;
	#description;
	#anneeProd;
	#tirage;
	#hauteur;
	#largeur;
	#datePublication;
	#idMembre;
	#idPays;
	#chemin;
	#temps;
	#nbMise;
	#miseMax;
	#btnMiser;

	constructor(elementHTML = null, conteneur = null, enchereInfo=null) {
		this.#conteneurHTML = conteneur;

		this.#template = document.querySelector(".js-template-enchere");

		if (elementHTML != null) {
			this.#elementHTML = elementHTML;
			this.#idEnchere = this.#elementHTML.querySelector('.js-enchere').dataset.idenchere;
			this.#btnFavori =
				this.#elementHTML.querySelector(".icone-favori");

			this.#btnFavori.addEventListener(
				"click",
				this.#modifierFavori.bind(this)
			);
		} else {
			const {
				idEnchere,
				dateDebut,
				dateFin,
				prixPlancher,
				estimation,
				idDevise,
				statut,
				lord,
				nbTimbre,
				idTimbre,
				titre,
				description,
				anneeProd,
				tirage,
				hauteur,
				largeur,
				datePublication,
				idMembre,
				idPays,
				chemin,
				estFavori,
				temps,
				nbMise,
				miseMax,
			} = enchereInfo;

			this.#idEnchere = idEnchere;
			this.#dateDebut = dateDebut;
			this.#dateFin = dateFin;
			this.#prixPlancher = prixPlancher;
			this.#estimation = estimation;
			this.#idDevise = idDevise;
			this.#statut = statut;
			this.#lord = lord;
			this.#estFavori = estFavori ? estFavori : 0;
			this.#nbTimbre = nbTimbre;
			this.#idTimbre = idTimbre;
			this.#titre = titre;
			this.#description = description;
			this.#anneeProd = anneeProd;
			this.#tirage = tirage;
			this.#hauteur = hauteur;
			this.#largeur = largeur;
			this.#datePublication = datePublication;
			this.#idMembre = idMembre;
			this.#idPays = idPays;
			this.#chemin = chemin;
			this.#nbMise = nbMise;
			this.#miseMax = miseMax;
			this.#temps = temps;

			this.#injecterHTML();
		}
	}

	async #injecterHTML() {
		const clone = this.#template.content.cloneNode(true);

		this.#conteneurHTML.append(clone);
		this.#elementHTML = this.#conteneurHTML.lastElementChild;

		//remplacer data
		this.#elementHTML.querySelector(
			"[data-render='idEnchere']"
		).textContent = this.#idEnchere;
		this.#elementHTML.querySelector("[data-idenchere]").dataset.idenchere =
			this.#idEnchere;

		const favoriClasse = this.#estFavori == 1 ? "fa-solid" : "fa-regular";
		this.#elementHTML
			.querySelector(".icone-favori")
			.classList.add(favoriClasse);

		const dataFavori = this.#estFavori ? "true " : "false";
		this.#elementHTML.querySelector("[data-favori]").dataset.favori =
			dataFavori;

		const lordClasse = this.#lord ? "fa-solid" : "fa-regular";
		this.#elementHTML
			.querySelector(".icone-lord")
			.classList.add(lordClasse);

		const dataLord = this.#lord ? "true " : "false";
		this.#elementHTML.querySelector("[data-lord]").dataset.lord = dataLord;

		if (!this.#lord) {
			this.#elementHTML
				.querySelector(".fa-award")
				.classList.add("invisible");
		}

		this.#elementHTML.querySelector(".media-cadre > img").src =
			Site.instance.upload() + this.#chemin;
		this.#elementHTML.href =
			Site.instance.base() + "/enchere/voir?idEnchere=" + this.#idEnchere;

		let titre;
		if (this.#nbTimbre > 1) {
			titre = `Lot de plusieurs timbres (${this.#nbTimbre})`;
		} else {
			titre = this.#titre;
		}
		this.#elementHTML.querySelector("[data-render='titre']").textContent =
			titre;

		const estAdmin = sessionStorage.getItem("estAdmin");
		if (estAdmin === "0") {
			this.#elementHTML
				.querySelector(".icone-lord")
				.classList.add("invisible");
		}

		if (this.#elementHTML.querySelector("[data-render='tempEtiquette']")) {
			let tempsEtiquette;
			let temps;
			if (this.#temps.avantDebut) {
				tempsEtiquette = "Temps avant l'enchère";
				temps = this.#temps.avantDebut;
			} else {
				tempsEtiquette = "Temps restant";
				temps = this.#temps.avantFin;
			}
			this.#elementHTML.querySelector(
				"[data-render='tempEtiquette']"
			).textContent = tempsEtiquette;

			this.#elementHTML.querySelector(
				"[data-render='temps']"
			).textContent = temps;
		}

		let nbmise;
		if (this.#nbMise > 0) {
			nbmise = `(${this.#nbMise} mises)`;
		} else {
			nbmise = ``;
		}
		this.#elementHTML.querySelector("[data-render='nbMise']").textContent =
			nbmise;

		let miseCourante;
		if (this.#nbMise > 0) {
			miseCourante = `${this.#idDevise} ${this.#miseMax}`;
		} else {
			miseCourante = `Aucune mise`;
		}
		this.#elementHTML.querySelector(
			"[data-render='miseCourante']"
		).textContent = miseCourante;

		let estimation;
		if (this.#estimation) {
			estimation = `${this.#idDevise} ${this.#estimation}`;
		} else {
			estimation = "N/A";
		}
		this.#elementHTML.querySelector(
			"[data-render='estimation']"
		).textContent = estimation;

		this.#elementHTML.querySelector(
			"[data-render='anneeProd']"
		).textContent = this.#anneeProd;

		this.#btnMiser = this.#elementHTML.querySelector("button");
		if (this.#statut == "CREE") {
			this.#btnMiser.dataset.couleur = "sombre";
			this.#btnMiser.classList.add("nonClickable");
		} else if (this.#statut == "OUVERT") {
			this.#btnMiser.dataset.couleur = "secondaire";
		}

		//ecouteur d'evenement
		this.#btnFavori = this.#elementHTML.querySelector(".icone-favori");
		this.#btnLord = this.#elementHTML.querySelector(".icone-lord");

		//ecouteur d'evenement
		this.#btnFavori.addEventListener(
			"click",
			this.#modifierFavori.bind(this)
		);

		if (this.#btnLord) {
			this.#btnLord.addEventListener(
				"click",
				this.#modifierLord.bind(this)
			);
		}

		if (this.#btnMiser) {
			this.#btnMiser.addEventListener("click", this.#miser.bind(this));
		}
	}

	#prevenirRedirection(evenement) {
		if (
			evenement.target.classList.contains("icone-favori") ||
			evenement.target.classList.contains("icone-lord") ||
			evenement.target.classList.contains("nonClickable")
		) {
			evenement.preventDefault();
		}
	}

	async #modifierFavori(evenement) {
		this.#prevenirRedirection(evenement);

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
		this.#prevenirRedirection(evenement);

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

	async #miser(evenement) {
		evenement.preventDefault();
		window.location.href =
			"http://localhost:8080/stampee/mise/creer?idEnchere=" +
			this.#idEnchere;
	}

	#trier(tri){
		
	}
}

export default Enchere;
