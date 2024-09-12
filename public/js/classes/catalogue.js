import CarteLot from "./CarteLot.js";

class Catalogue {
	constructor(){

		this.checkboxFiltre = document.querySelector("input#filtre-bouton");
		this.filtres = document.querySelector(".filtre");
		this.iconeModeListe = document.querySelector("svg[data-mode='liste']");
		this.iconeModeGrille = document.querySelector("svg[data-mode='grille']");
		this.boutonActive = document.querySelector(["[data-enchere='active']"]);
		this.boutonPassee = document.querySelector(["[data-enchere='passee']"]);
		
		this.conteneurCatalogue = document.querySelector(".catalogue-conteneur");
		this.statutAffichage = document.querySelector(".catalogue-conteneur[data-enchere]").dataset.enchere;
		this.mode = 'liste';

		this.instancierCarteLot();

		//ecouteur d'evenement
		this.checkboxFiltre.addEventListener("click", this.affichageFiltre.bind(this));
		this.iconeModeListe.addEventListener("click", this.changerMode.bind(this));
		this.iconeModeGrille.addEventListener("click", this.changerMode.bind(this));
		if(this.boutonActive && this.boutonPassee ){
			this.boutonActive.addEventListener("click", this.changerStatutAffichage.bind(this));
			this.boutonPassee.addEventListener("click", this.changerStatutAffichage.bind(this));
		}


	}

	instancierCarteLot(){

		let template;

		if(this.statutAffichage == "active"){
			template = this.conteneurCatalogue.querySelector(".template-carteLot")
		} else {
			template = this.conteneurCatalogue.querySelector(".template-archive")
		}

		for(let i = 0; i<=9 ; i++){
			new CarteLot(template);
		}
	}

	changerMode(evenement){

		if(evenement) {
			this.mode = evenement.currentTarget.dataset.mode;
		}


		if (this.mode == "grille"){
			this.conteneurCatalogue.classList.add("grille");
			this.conteneurCatalogue.classList.remove("liste");
			this.iconeModeGrille.dataset.selected = true;
			this.iconeModeListe.dataset.selected = false;
		} else if (this.mode == "liste"){
			this.conteneurCatalogue.classList.add("liste");
			this.conteneurCatalogue.classList.remove("remove");
			this.iconeModeListe.dataset.selected = true;
			this.iconeModeGrille.dataset.selected = false;
		}; 

		let articles = this.conteneurCatalogue.querySelectorAll(".carte-lot");

		articles.forEach(function(article){
			article.dataset.mode = this.mode;
		}.bind(this))
		
	}

	affichageFiltre(){

		if (this.checkboxFiltre.checked){
			this.filtres.dataset.ecran = "mobile";
		} else {
			this.filtres.dataset.ecran = "bureau";
		}
	}

	changerStatutAffichage(evenement){
		this.statutAffichage = evenement.currentTarget.dataset.enchere;
		
		if(this.statutAffichage === 'active'){
			this.boutonActive.dataset.selected="true";
			this.boutonPassee.dataset.selected="false";
		} else {
			this.boutonActive.dataset.selected="false";
			this.boutonPassee.dataset.selected="true";
		}

		const cartes = document.querySelectorAll("a:has(.carte-lot)");
		cartes.forEach(function(c){
			c.remove();
		})

		this.instancierCarteLot();
		this.changerMode();
	
	}
}

export default Catalogue;