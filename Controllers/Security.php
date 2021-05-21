<?php

namespace App\Controller;

use App\Core\Security as Secu;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker as c;

use App\Models\User;

class Security{



    public function adminAction(){
        $view = new View("dashboard","back");
    }

	public function loginAction(){

		$user = new User();

		$view = new View("login");

		$formLogin = $user->formLogin();

		if(!empty($_POST)){

			$errors = FormValidator::check($formLogin, $_POST);

			if(empty($errors)){
                $user->setEmail($_POST['email']) ;

			    if(Secu::userExist($user,$user->getEmail())) {
                    if(Secu::userTestConnection($user,$_POST['pwd'])) {
                        $tmp = $user->searchOneColWithOneRow("user","*","email",$user->getEmail()) ;

                       // $user->setToken() ;
                        $user->setId($tmp['id']) ;

                        $user->save() ;

                        $user->setLastname($tmp['lastname']) ;
                        $user->setCountry($tmp['country']) ;
                        $user->setFirstname($tmp['firstname']) ;
                        $user->setRole($tmp['role']);
                        $user->setStatus($tmp['status']) ;

                        $_SESSION['user'] = $user ;
                        header('Location: /dashboard');
                    } else {

                        $view->assign("pwd","Mot de passe incorrect");
                    }
                }



			}else{
				$view->assign("errors", $errors);
			}
		}

		$view->assign("formLogin", $formLogin);

	}

	public function registerAction(){


		$user = new User();
		$view = new View("register");


		$form = $user->formRegister();

		if(!empty($_POST)){
            !Secu::userExist($user, $_POST["email"]);
			$errors = FormValidator::check($form, $_POST);

			if(empty($errors)){
				    $user->setFirstname($_POST["firstname"]);
                    $user->setLastname($_POST["lastname"]);
                    $user->setEmail($_POST["email"]);
                    $user->setPwd($_POST["pwd"]);
                    $user->setCountry($_POST["country"]??$user->getCountry());
                    $user->save();
			}else{
				$view->assign("errors", $errors);
			}
		}
		$view->assign("form", $form);
	}

	public function logoutAction(){

	    echo "Logout action";

	}


	

}
