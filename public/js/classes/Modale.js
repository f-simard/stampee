class Modale {
	constructor(){
		this.conteneurHTML = document.body;
		this.elementHTML;

		this.injecterHTML();

	}

	injecterHTML(){
		let gabarit = 
			`<div class="modale invisible">
				<picture>
					<img class="prototype-agrandi" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="image de timbre">
				</picture>
			</div>
			`;
			this.conteneurHTML.insertAdjacentHTML("afterbegin", gabarit);
			this.elementHTML = this.conteneurHTML.firstElementChild;
	
			this.elementHTML.addEventListener("click", this.fermer.bind(this));

	}

	afficher() {
        this.elementHTML.classList.remove("invisible");
    }

    fermer() {
        this.elementHTML.classList.add("invisible");
    }


}

export default Modale;