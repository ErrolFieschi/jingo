<?php

namespace App\Controller;

use App\Core\View;

class Main{


	public function defaultAction(){

		$view = new View("home");
	}


	public function statsAction(){

		$view = new View("statistiques","back");
	}

    public function trainingAction(){

        $view = new View("training", "back");
    }
}
