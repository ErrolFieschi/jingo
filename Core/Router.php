<?php
namespace App\Core;




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

                $uris = Helpers::getUrlAsArray() ;
                if($uris[0]== 'install') {
                    if($uris[1]==1) {
                        $this->setController('Core\Installer');
                        $this->setAction('setup');
                        $this->setAuth(false);
                    } else if($uris[1]==2) {
                        $this->setController('Core\Installer');
                        $this->setAction('setupMailing');
                        $this->setAuth(false);
                    } else if($uris[1]==3) {
                        $this->setController('Core\Installer');
                        $this->setAction('setupDatabase');
                        $this->setAuth(false);
                    }
                } else {
                    $tmp = count($uris) ;
                    $this->setAuth(Middleware::isAuthNeeded());
                    $this->setAction(Middleware::getAction());

                    if($tmp == 1) {
                        // GET FORMATION CONTROLLER AND SHOW ACTION
                        if(Middleware::isFormationExist($uris[$tmp-1])) {
                            if (! $this->getAuth() ) {
                                $this->setController(Middleware::getControllerFormation());
                            }
                        } else $this->redirect404();

                    } else if ($tmp == 2 ) {
                        // GET PART CONTROLLER AND SHOW ACTION
                        if(Middleware::isPartExist($uris[$tmp-1],$uris[$tmp-2])) {
                            if (!$this->getAuth()) {
                                $this->setController(Middleware::getControllerPart());
                            }
                        } else  $this->redirect404();

                    } else if ($tmp == 3) {
                        // GET LESSON CONTROLLER AND SHOW ACTION
                        if(Middleware::isLessonExist($uris[$tmp-1],$uris[$tmp-2],$uris[$tmp-3])) {
                            if (!$this->getAuth()) {
                                $this->setController(Middleware::getControllerLesson());
                            }
                        } else $this->redirect404();
                    }
                }
			}
		}else{
			die("Le fichier routes.yml ne fonctionne pas !");
		}
	}

	public function setUri($uri){
		$this->uri = trim(mb_strtolower($uri));

	}

	public function redirect404() {
        header("HTTP/1.0 404 Not Found");
	    new View('404') ;
        die();
    }
    public static function redicrection404() {
        (new Router(''))->redirect404();
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
