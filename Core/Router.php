<?php
namespace App\Core;

use App\Models\User;

class Router
{

    private $routes = [];
    private $uri;
    private $routesPath = "routes.yml";
    private $controller;
    private $action;
    private $auth;
	private $role;

    /**
     * Router constructor.
     * @param $uri
     */
    public function __construct($uri){
		$this->setUri($uri);
		if(file_exists($this->routesPath)){
			//[/] => Array ( [controller] => Global [action] => default )
			$this->routes = yaml_parse_file($this->routesPath);

			if( !empty($this->routes[$this->uri]) && $this->routes[$this->uri]["controller"] && $this->routes[$this->uri]["action"]){
                
                $this->setController($this->routes[$this->uri]["controller"]);
                $this->setAction($this->routes[$this->uri]["action"]);
                $this->setAuth($this->routes[$this->uri]["auth"]);
                
                if (!empty($this->routes[$this->uri]["role"])) {
                    $this->setRole($this->routes[$this->uri]["role"]);
                    if (array_search($this->getRole(), User::rolesUser()) >= Security::userRole()) {
                        header('Location: /page/accueil');
                    }
                }

			}else{

                $uris = Helpers::getUrlAsArray() ;

                 if ($uris[0] == 'page') {
                    $tmp = count($uris) ;
                    $this->setAuth(Middleware::isAuthNeeded());
                    $this->setAction(Middleware::getFrontAction());

                    if( Middleware::isPageExist($uris[1])) {
                        $this->setController('Page');
                        $this->setAction('renderPage');
                        $this->setAuth(Middleware::isAuthNeeded());
                    } else {
                        if($tmp == 2) {
                            // GET FORMATION CONTROLLER AND SHOW ACTION
                            if(Middleware::isFormationExist($uris[$tmp-1])) {
                                if (! $this->getAuth() ) {
                                    $this->setController(Middleware::getControllerFormation());
                                }
                            } else $this->redirect404();

                        } else if ($tmp == 3 ) {
                            // GET PART CONTROLLER AND SHOW ACTION

                            if(Middleware::isPartExist($uris[$tmp-1],$uris[$tmp-2])) {
                                if (!$this->getAuth()) {
                                    $this->setController(Middleware::getControllerPart());
                                }
                            } else  $this->redirect404();

                        } else if ($tmp == 4) {
                            // GET LESSON CONTROLLER AND SHOW ACTION
                            if(Middleware::isLessonExist($uris[$tmp-1],$uris[$tmp-2],$uris[$tmp-3])) {
                                if (!$this->getAuth()) {
                                    $this->setController(Middleware::getControllerLesson());
                                }
                            } else $this->redirect404();
                        }
                    }
                }
                else if ($uris[0] == 'courses') {
                    $tmp = count($uris) ;
                    $this->setAuth(Middleware::isAuthNeeded());
                    $this->setAction(Middleware::getFrontAction());

                    if($tmp == 2) {
                        // GET FORMATION CONTROLLER AND SHOW ACTION
                        if(Middleware::isFormationExist($uris[$tmp-1])) {
                            if (! $this->getAuth() ) {
                                $this->setController(Middleware::getControllerFormation());
                            }
                        } else $this->redirect404();

                    } else if ($tmp == 3 ) {
                        // GET PART CONTROLLER AND SHOW ACTION

                        if(Middleware::isPartExist($uris[$tmp-1],$uris[$tmp-2])) {
                            if (!$this->getAuth()) {
                                $this->setController(Middleware::getControllerPart());
                            }
                        } else  $this->redirect404();

                    } else if ($tmp == 4) {
                        // GET LESSON CONTROLLER AND SHOW ACTION
                        if(Middleware::isLessonExist($uris[$tmp-1],$uris[$tmp-2],$uris[$tmp-3])) {
                            if (!$this->getAuth()) {
                                $this->setController(Middleware::getControllerLesson());
                            }
                        } else $this->redirect404();
                    }
                }
                else {
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

    /**
     * @param $uri
     */
    public function setUri($uri){
		$this->uri = trim(mb_strtolower($uri));

	}

    /**
     *
     */
    public function redirect404() {
        header("HTTP/1.0 404 Not Found");
	    new View('404') ;
        die();
    }

    /**
     *
     */
    public static function redicrection404() {
        (new Router(''))->redirect404();
    }

    /**
     * @param $controller
     */
    public function setController($controller){
		$this->controller = $controller;
	}


    /**
     * @param $action
     */
    public function setAction($action){
		$this->action = $action."Action";
	}


    /**
     * @return mixed
     */
    public function getController(){
		return $this->controller;
	}


    /**
     * @return mixed
     */
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

     /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $auth
     */
    public function setRole($role)
    {
        $this->role = array_search($role, User::rolesUser());
    }

}
