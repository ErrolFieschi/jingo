<?php
namespace App\Core;

use App\Core\Middleware ;


class Router
{
	private $routes = [];
	private $uri;
	private $routesPath = "routes.yml";
	private $controller;
	private $action;
	private $auth;

	public function __construct($uri){
		$this->setUri($uri);
		if(file_exists($this->routesPath)){
			//[/] => Array ( [controller] => Global [action] => default )
			$this->routes = yaml_parse_file($this->routesPath);

			if( !empty($this->routes[$this->uri]) && $this->routes[$this->uri]["controller"] && $this->routes[$this->uri]["action"]){

				$this->setController($this->routes[$this->uri]["controller"]);
				$this->setAction($this->routes[$this->uri]["action"]);
                $this->setAuth($this->routes[$this->uri]["auth"]);

			}else{

                $this->uri = substr($this->uri,1);
                $uris = explode("/",$this->uri) ;
                $tmp = count($uris) ;

                $this->setAuth(\App\Core\Middleware::isAuthNeeded());
                $this->setAction(Middleware::getAction());

                if($tmp == 1) {
                    // GET FORMATION CONTROLLER AND SHOW ACTION
                    if(\App\Core\Middleware::isFormationExist($uris[$tmp-1])) {
                        if (! $this->getAuth() ) {
                            $this->setController(Middleware::getControllerFormation());
                        }
                    } else die("Chemin inexistant : 404");

                } else if ($tmp == 2 ) {
                    // GET PART CONTROLLER AND SHOW ACTION
                    if(\App\Core\Middleware::isPartExist($uris[$tmp-1])) {
                        if (!$this->getAuth()) {
                            $this->setController(Middleware::getControllerPart());
                        }
                    } else  die("Chemin inexistant : 404");

                } else if ($tmp == 3) {
                    // GET LESSON CONTROLLER AND SHOW ACTION
                    if(\App\Core\Middleware::isLessonExist($uris[$tmp-1])) {
                        if (!$this->getAuth()) {
                            $this->setController(Middleware::getControllerLesson());
                        }
                    } else  die("Chemin inexistant : 404");
                }

                //die("Chemin inexistant : 404");
				//remplacer par un header location
			}

		}else{



			die("Le fichier routes.yml ne fonctionne pas !");
		}
	}

	public function setUri($uri){
		$this->uri = trim(mb_strtolower($uri));

	}


	public function setController($controller){
		$this->controller = $controller;
	}


	public function setAction($action){
		$this->action = $action."Action";
	}


	public function getController(){
		return $this->controller;
	}


	public function getAction(){
		return $this->action;
	}

    /**
     * @return mixed
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param mixed $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

}
