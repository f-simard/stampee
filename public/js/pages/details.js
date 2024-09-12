import Modale from "../classes/modale.js";

(function(){
	let modale = new Modale();

	let agrandir = document.querySelector(".medias-timbre-principal");
	agrandir.addEventListener("click", modale.afficher.bind(modale));

	const iconeFavori = document.querySelector(".icone-favori");
	iconeFavori.addEventListener("click", changerIcone)
})()

function changerIcone(evenement){

	const icone = evenement.currentTarget;
	icone.classList.toggle("fa-regular");
	icone.classList.toggle("fa-solid");

}