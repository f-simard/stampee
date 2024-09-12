<?php 
namespace App\Controllers;

use App\Providers\View;

class MembreController{

		public function index(){

		return View::render('error', ['msg'=>"testController index"]);

	}
}