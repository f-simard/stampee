<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset}}css/main.css">
	<script src="{{asset}}js/pages/index.js" type="module"></script>
	<title>{{titre}}</title>
</head>
<header class="entete-site">
	<div>
		<a href="{{base}}/">
			<picture class="logo">
				<img src="{{asset}}/img/logoStampee-ivory.png" alt="Logo Lord Stampee">
			</picture>
		</a>
		<div class="icone-conteneur">
			<a href="{{base}}/enConstruction" data-ecran="tablette">
				<svg aria-label="icone loupe de recherche" role="img" class="icone" data-setCouleur="clairSurPrimaire" width="50" height="50" viewBox="0 0 50 50" fill="transparent" xmlns="http://www.w3.org/2000/svg">
					<title>loupe de recherche</title>
					<path d="M36.3162 31.8301C41.7259 24.1987 41.0022 13.5623 34.1541 6.72805C26.4948 -0.909352 14.0802 -0.909352 6.42095 6.72805C-1.2383 14.3685 -1.2383 26.7556 6.42095 34.393C13.2721 41.2272 23.9317 41.9492 31.5849 36.5527L44.0629 49L48.6765 44.1601L36.3162 31.8301ZM11.3512 29.4748C6.41794 24.5507 6.41794 16.5703 11.3512 11.6492C16.2875 6.72504 24.2875 6.72504 29.2208 11.6492C34.1571 16.5703 34.1571 24.5507 29.2208 29.4748C24.2875 34.396 16.2875 34.396 11.3512 29.4748Z" fill="#FEFEF2" stroke="#FEFEF2" stroke-width="0.5" stroke-miterlimit="5" />
				</svg>
			</a>
			<a href="{{base}}/enConstruction" data-ecran="bureau">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-label="globe" class="icone" width="50" height="50"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
					<title>Globe</title>
					<path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z" fill="#FEFEF2" stroke="#FEFEF2" />
				</svg>
			</a>
			<a href="{{base}}/membre/favori">
				<svg role="img" aria-label="icone marque page" class="icone" data-setCouleur="clairSurPrimaire" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
					<title>icone marque page</title>
					<g clip-path="url(#clip0_72_14)">
						<path d="M36.8571 0H11.1429C8.30143 0 6.02571 2.38667 6.02571 5.33333L6 48L24 40L42 48V5.33333C42 2.38667 39.6986 0 36.8571 0Z" fill="#FEFEF2" />
					</g>
					<defs>
						<clipPath id="clip0_72_14">
							<rect width="50" height="50" fill="white" />
						</clipPath>
					</defs>
				</svg>

			</a>
			<a href="{% if guest %}{{base}}/connexion {% else %} {{base}}/membre/voir?idMembre={{session.idMembre}} {% endif %}">
				<svg role="img" aria-label="icone avatar" class="icone" data-setCouleur="clairSurPrimaire" width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
					<title>Icone avatar</title>
					<path data-garde d="M27.6765 52C40.929 52 51.6765 41.2568 51.6765 28C51.6765 14.7432 40.9333 4 27.6765 4C14.4197 4 3.67651 14.7432 3.67651 28C3.67651 41.2568 14.4197 52 27.6765 52Z" stroke="#FEFEF2" stroke-width="7" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M27.7104 32.0452C20.3158 32.0452 13.9414 36.2934 10.7133 42.6678C14.9615 47.1528 21.0992 49.6707 27.7104 49.6707C34.3216 49.6707 40.4593 46.916 44.7075 42.6678C41.4794 36.5301 35.1049 32.0452 27.7104 32.0452Z" fill="#FEFEF2" />
					<path d="M27.7105 33.6591C21.2327 33.6979 15.1854 37.7309 12.4436 43.5415C12.4436 43.5415 12.1165 41.3291 12.1251 41.3378C20.2858 49.9719 35.0964 49.705 43.3389 41.299C43.3475 41.2904 42.9946 43.5673 42.9946 43.5673C42.6201 41.9619 41.7292 40.5415 40.6402 39.3277C37.4379 35.6606 32.5312 33.5429 27.7105 33.6591ZM27.7105 30.431C33.435 30.4913 38.8755 33.2761 42.732 37.4167C44.0147 38.794 45.1596 40.266 46.4207 41.7682C46.8167 42.2373 46.8339 42.9002 46.5111 43.3865L46.0764 44.0365C38.8282 51.3621 27.2672 53.6132 17.755 49.705C14.5957 48.4353 11.6775 46.4984 9.31021 44.002C8.72054 43.3994 8.61724 42.4999 8.9874 41.794C12.4824 34.9073 19.9716 30.2244 27.7105 30.431Z" fill="#FEFEF2" />
					<path d="M27.692 27.8868C31.9066 27.8868 35.3232 24.4702 35.3232 20.2555C35.3232 16.0409 31.9066 12.6243 27.692 12.6243C23.4773 12.6243 20.0607 16.0409 20.0607 20.2555C20.0607 24.4702 23.4773 27.8868 27.692 27.8868Z" fill="#FEFEF2" />
					<path d="M27.6918 25.9931C32.7276 25.9027 35.2972 19.8252 31.7205 16.2269C29.5985 14.0189 25.7893 14.0275 23.6631 16.2226C20.0648 19.7994 22.6215 25.9802 27.6918 25.9931ZM27.6918 29.7807C19.2169 29.7678 14.9644 19.5024 20.9299 13.4895C24.4981 9.77502 30.8855 9.77932 34.4579 13.4852C40.4407 19.4852 36.1968 29.8453 27.6918 29.7807Z" fill="#FEFEF2" />
				</svg>
			</a>
			<input type="checkbox" id="nav-bouton" aria-label="icone menu mobile">
		</div>
	</div>
	<nav class="navigation-principale">
		<h4><a href="{{base}}/enchere/catalogue" {% if navActive=="enchere" %} class="actif" {% endif %}>Enchères</a></h4>
		<h4><a href="{{base}}/enConstruction">Actualité</a></h4>
		<h4><a href="{{base}}/enConstruction">FAQ</a></h4>
		<h4><a href="{{base}}/enConstruction">À Propos</a></h4>
		<a href="{{base}}/enConstruction" data-ecran="mobile">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-label="globe" class="icone" width="50" height="50"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
				<title>Globe</title>
				<path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z" fill="#FEFEF2" stroke="#FEFEF2" />
			</svg>
		</a>
	</nav>
	<div class="filtre-recherche" data-ecran="mobile">
		<label for="recherche" data-ecran="mobile">Recherche</label>
		<div>
			<input type="text" name="recherche" id="recherche">
			<button class="bouton-reset">
				<picture class="icone bouton-reset" data-format="moyenne">
					<img src="{{asset}}/img/icones/loupe_ivory.svg" alt="recherche">
				</picture>
			</button>
		</div>
	</div>
</header>