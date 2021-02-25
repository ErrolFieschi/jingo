<?php

namespace App\Controller;

use App\Core\View;

class Main{


	public function homeAction(){

		$view = new View("home","back");
	}

	public function statsAction(){

		$view = new View("statistiques","back");
	}
}
