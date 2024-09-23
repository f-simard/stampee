import Catalogue from "./Catalogue.js";

class Site {
	static #instance;
	#catalogue;

	//Permet d'accéder à l'instance de la classe de n'importe où dans le code en utilisant App.instance
	static get instance() {
		return Site.#instance;
	}

	constructor() {

		//singleton
		if (Site.#instance) {
			return Site.#instance;
		} else {
			Site.#instance = this;
		}

		//generer catalogue
		this.#catalogue = new Catalogue();
	}

}

export default Site;
