<?php

namespace App\Providers;

use App\Providers\View;

class Auth
{
	static public function session()
	{
		if (isset($_SESSION['fingerPrint']) and ($_SESSION['fingerPrint'] ===  md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']))) {
			return true;
		} else {
			return View::redirect('connexion');
		}
	}

	static public function isAdmin()
	{

		if (self::session() && $_SESSION['isAdmin'] === 1) {
			return true;
		} else {
			return View::redirect('accesRefuse');
		}
	}
}
