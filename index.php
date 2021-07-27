<?php

namespace App;

use App\Core\Installer;
use App\Core\Router;
use App\Core\ConstantMaker;
use App\Core\Security;

session_start() ;

if(!file_exists('.env'))
    file_put_contents('.env','#Creation du .env',FILE_TEXT) ;


require "Autoload.php";
Autoload::register();
new ConstantMaker();


if(file_exists('Core/data.sql')) {

    $controller = new Installer() ;
    if(!isset($_SESSION['isStepOneOk']) || $_SERVER['REQUEST_URI'] == '/install/1')
        $controller->setupAction();
    else if(isset($_SESSION['isStepOneOk']) && !isset($_SESSION['isStepTwoOk']) || $_SERVER['REQUEST_URI'] == '/install/2')
        $controller->setupMailingAction();
    else if(isset($_SESSION['isStepOneOk']) && isset($_SESSION['isStepTwoOk']) || $_SERVER['REQUEST_URI'] == '/install/3')
        $controller->setupDatabaseAction();

} else {

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
                        header('Location: /login');
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
}










