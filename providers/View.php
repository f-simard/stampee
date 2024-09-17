<?php

namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{

	static public function render($template, $data = [])
	{
		$loader = new FilesystemLoader('views');
		$twig = new Environment($loader);
		$twig->addGlobal('asset', ASSET);
		$twig->addGlobal('base', BASE);
		$twig->addGlobal('upload', UPLOAD);
		$twig->addGlobal("session", $_SESSION);

		if (isset($_SESSION['fingerPrint']) and md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
			$guest = false;
		} else {
			$guest = true;
		}
		$twig->addGlobal("guest", $guest);

		echo $twig->render($template . '.php', $data);
	}


	static public function redirect($url)
	{
		header('location:' . BASE . '/' . $url);
	}

	static public function msg($data = [])
	{

		if (isset($data['succesSuppr'])) {
			return "Suppression réussie";
		} else if (isset($data['successMiseAJour'])) {
			return "Mise à jour réussie";
		} else if (isset($data['succesAjout'])) {
			return "Ajout réussi";
		} else {
			return null;
		};
	}
}
