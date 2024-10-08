import Catalogue from "./Catalogue.js";
import Enchere from "./Enchere.js";

class Site {
	static #instance;
	#catalogue;
	#imageAgrandissable;
	#base;
	#asset;
	#upload;
	#estAdmin;
	#enchere;

	//Permet d'accéder à l'instance de la classe de n'importe où dans le code en utilisant App.instance
	static get instance() {
		return Site.#instance;
	}

	constructor() {
		this.#base = "http://localhost:8080/stampee";
		this.#asset = "/stampee/public/";
		this.#upload = "/stampee/uploads/";

		//singleton
		if (Site.#instance) {
			return Site.#instance;
		} else {
			Site.#instance = this;
		}

		//generer catalogue
		if (document.querySelector(".js-catalogue")) {
			this.#catalogue = new Catalogue();
		}

		//genere enchere
		if (document.querySelector(".js-enchere")) {
			const elementHTML = document.querySelector(".enchere");
			this.#enchere = new Enchere(elementHTML);
		}

		if (document.querySelector(".agrandir")) {
			this.#imageAgrandissable = document.querySelector(".agrandir");
			this.#imageAgrandissable.addEventListener(
				"mouseenter",
				this.#agrandirImage.bind(this, 2)
			);
			this.#imageAgrandissable.addEventListener(
				"mouseleave",
				function () {
					const loupe = document.querySelector(".agrandir__curseur");
					loupe.remove();
				}
			);
		}

		this.#setAdmin();
		this.#setMembre();
	}

	base() {
		return this.#base;
	}
	asset() {
		return this.#asset;
	}
	upload() {
		return this.#upload;
	}

	//src: https://www.w3schools.com/HOWTO/howto_js_image_magnifier_glass.asp
	#agrandirImage(zoom) {
		let img, loupe, w, h, bw;
		img = document.querySelector(".agrandir > img");

		//creer loupe
		loupe = document.createElement("DIV");
		loupe.setAttribute("class", "agrandir__curseur");

		//inserer loupe
		img.parentElement.insertBefore(loupe, img);

		//assigner propriété de fond pour la loupe
		loupe.style.backgroundImage = "url('" + img.src + "')";
		loupe.style.backgroundRepeat = "no-repeat";
		loupe.style.backgroundSize =
			img.offsetWidth * zoom + "px " + img.offsetHeight * zoom + "px";
		bw = 2;
		w = loupe.offsetWidth / 2;
		h = loupe.offsetHeight / 2;

		//event listener
		loupe.addEventListener("mousemove", bougerLoupe);
		img.addEventListener("mousemove", bougerLoupe);

		/*mobile:*/
		loupe.addEventListener("touchmove", bougerLoupe);
		img.addEventListener("touchmove", bougerLoupe);

		function bougerLoupe(e) {
			let pos, x, y;
			e.preventDefault();

			//position du curseur
			pos = getCursorPos(e);
			x = pos.x;
			y = pos.y;

			//empecher de mettre la loupe à l'exterieur de l'image
			if (x > img.offsetWidth - w / zoom) {
				x = img.offsetWidth - w / zoom;
			}
			if (x < w / zoom) {
				x = w / zoom;
			}
			if (y > img.offsetHeight - h / zoom) {
				y = img.offsetHeight - h / zoom;
			}
			if (y < h / zoom) {
				y = h / zoom;
			}

			loupe.style.left = x - w + "px";
			loupe.style.top = y - h + "px";
			/* Display what the magnifier glass "sees": */
			loupe.style.backgroundPosition =
				"-" + (x * zoom - w + bw) + "px -" + (y * zoom - h + bw) + "px";
		}

		function getCursorPos(e) {
			let a,
				x = 0,
				y = 0;
			/* Get the x and y positions of the image: */
			a = img.getBoundingClientRect();
			/* Calculate the cursor's x and y coordinates, relative to the image: */
			x = e.clientX - a.left;
			y = e.clientY - a.top;
			/* Consider any page scrolling: */
			x = x - window.scrollX;
			y = y - window.scrollY;
			return { x: x, y: y };
		}
	}

	async #setAdmin() {
		const reponse = await fetch(this.#base + "/Auth/estAdmin");
		const data = await reponse.json();
		sessionStorage.setItem("estAdmin", data["estAdmin"]);
	}

	async #setMembre() {
		const reponse = await fetch(this.#base + "/Auth/idMembre");
		const data = await reponse.json();
		console.log(data);
		sessionStorage.setItem("idMembre", data["idMembre"]);
	}
}

export default Site;
