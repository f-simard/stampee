import Catalogue from "./Catalogue.js";

class Site {
	static #instance;
	#catalogue;
	#imageAgrandissable;

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

		if (document.querySelector(".medias-timbre-principal ")) {
			this.#imageAgrandissable = document.querySelector(
				".medias-timbre-principal "
			);
			this.#imageAgrandissable.addEventListener('mouseenter', this.#agrandirImage.bind(this, 2));
			this.#imageAgrandissable.addEventListener('mouseleave', function(){
				const loupe = document.querySelector(".agrandir__curseur");
				loupe.remove();
			})
		}
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
			img.width * zoom + "px " + img.height * zoom + "px";
		bw = 3;
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
			if (x > img.width - w / zoom) {
				x = img.width - w / zoom;
			}
			if (x < w / zoom) {
				x = w / zoom;
			}
			if (y > img.height - h / zoom) {
				y = img.height - h / zoom;
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
			x = e.pageX - a.left;
			y = e.pageY - a.top;
			/* Consider any page scrolling: */
			x = x - window.scrollX;
			y = y - window.scrollY;
			return { x: x, y: y };
		}
	}
}

export default Site;
