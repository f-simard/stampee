<?php 
namespace App\Controllers;

use App\Providers\View;

class TestController{

		public function index(){

		return View::render('layouts/test');

	}
}