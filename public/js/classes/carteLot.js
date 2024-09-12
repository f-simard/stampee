class CarteLot {
    constructor(template){
        this.lot;
        this.nom;
        this.date;
        this.description;
        this.conteneur = document.querySelector(".catalogue-conteneur");
        this.template = template;
        
        this.injecterHTML();
    }

    injecterHTML(){
        let template = this.template.content.cloneNode(true);
        this.conteneur.append(template);

		this.element = this.conteneur.lastElementChild;

		this.iconeFavori = this.element.querySelector(".icone-favori");
		if(this.iconeFavori){
			this.iconeFavori.addEventListener("click", this.changerIcone.bind(this));
		}

    }

	changerIcone(evenement){
		evenement.preventDefault();

		const icone = evenement.currentTarget;
		icone.classList.toggle("fa-regular");
		icone.classList.toggle("fa-solid");


	}
}

export default CarteLot;