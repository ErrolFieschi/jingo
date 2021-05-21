<?php

namespace App;

use App\Core\Router;
use App\Core\ConstantMaker;
use App\Core\Helpers as h;
use App\Core\Security;

session_start() ;

require "Autoload.php";


Autoload::register();


new ConstantMaker();



// $uri  => /se-connecter?user_id=2 => /se-connecter
$uriExploded = explode("?", $_SERVER["REQUEST_URI"]);

$uri = $uriExploded[0];

$router = new Router($uri);

$controller = $router->getController();
$action = $router->getAction();
$auth = $router->getAuth();




if( file_exists("./Controllers/".$controller.".php")){

	include "./Controllers/".$controller.".php";
	// SecurityController =>  App\Controller\SecurityController

	$controller = "App\\Controller\\".$controller;
	if(class_exists($controller)){
		// $controllerontroller ====> SecurityController
		$controllerObjet = new $controller();
		if(method_exists($controllerObjet, $action)){
		    if ($auth === true) {
                if (Security::isConnected()) {
                    $controllerObjet->$action();
                } else {
                    echo "RIEN A FOUTRE";
//                    header("location : /"); // RIEN A FOUTRE
                }
            } else {
                $controllerObjet->$action();
            }

		}else{
			die("L'action' : ".$action." n'existe pas");
		}

	}else{
	
		die("La classe controller : ".$controller." n'existe pas");
	}


}else{
	die("Le fichier controller : ".$controller." n'existe pas");
}








