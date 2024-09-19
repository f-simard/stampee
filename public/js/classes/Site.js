import Catalogue from "./Catalogue.js";

class Site {
	static #instance;
	#catalogue;
	#enchere

	//Permet d'accéder à l'instance de la classe de n'importe où dans le code en utilisant App.instance
	static get instance() {
		return Site.#instance;
	}

	constructor() {
		//singleton
		if (Site.#instance) {
			return App.#instance;
		} else {
			Site.#instance = this;
		}

		//generer catalogue
		this.#catalogue = new Catalogue;
	}

	async #ajouterFavori(){
		const reponse  = await fetch();
	}

	async #retirerFavori(){
		const reponse = await fetch();
	}
}

export default Site;