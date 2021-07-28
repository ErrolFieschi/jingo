<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\Security as Secu;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\Installer;

use App\Models\User;

class Security{

    public function adminAction(){

        $view = new View("dashboard","back");

        $userCtrl = new User();

        $trainingsByTag = $userCtrl->innerJoinGroupBy('training', 'training_tag', 'training_tag_id', 'name');

        foreach($trainingsByTag as $key => $trainingByTag) {
            $trainingsByTagName[$key] = $trainingByTag[0];
            $trainingsByTagData[$key] = $trainingByTag[1];
        }
        
        $view->assign('trainingsByTagName', $trainingsByTagName);
        $view->assign('trainingsByTagData', $trainingsByTagData);
    }

	public function loginAction(){

        if( isset($_COOKIE["connectionUser"])  ) {
            $user = new User();
            $data = $user->searchOneColWithOneRow("user","token,email","token",$_COOKIE['connectionUser']);
           // echo "<pre>"; var_dump($data);
            $user->setEmail($data["email"]) ;
            if(Secu::userExist($user,$user->getEmail())) {
                $user->setToken($data["token"]);
                if(Secu::userTestConnectionByToken($user,$data["token"])) {
                    self::setTokenWhenConnectionOK($user);
                    header('Status: 301 Permanently', false, 301);
                    header('Location: /dashboard');
                }
            }
        }

		$user = new User();
		$view = new View("login",'installer');
		$formLogin = $user->formLogin();

		if(!empty($_POST)){

			$errors = FormValidator::check($formLogin, $_POST);

			if(empty($errors)){
                $user->setEmail($_POST['email']) ;
			    if(Secu::userExist($user,$user->getEmail())) {
                    if(Secu::userTestConnection($user,$_POST['pwd'])) {

                        self::setTokenWhenConnectionOK($user);

                        if( isset($_POST['checkLogin']) ) {

                            setcookie("connectionUser",  $user->getToken() ,time()+3600*24) ;
                        }

                        header('Status: 301 Permanently', false, 301);
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

	private function setTokenWhenConnectionOK(User $user) {
        $tmp = $user->searchOneColWithOneRow("user","id","email",$user->getEmail()) ;
        $user->setToken() ;
        $user->setId($tmp['id']) ;

        $role = $user->searchOneColWithOneRow("user",'role','email',$user->getEmail()) ;
        $user->setRole($role['role']) ;

        $user->save() ;
        $_SESSION['token'] = $user->getToken() ;
        $_SESSION['id'] = $user->getId() ;
    }

	public function registerAction(){
		$user = new User();
		$view = new View("register",'installer');
		$form = $user->formRegister();

		if(!empty($_POST)){
            !Secu::userExist($user, $_POST["email"]);
			$errors = FormValidator::check($form, $_POST);

			if(empty($errors)){
				    $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                    $user->setLastname(htmlspecialchars($_POST["lastname"]));
                    $user->setEmail(htmlspecialchars($_POST["email"]));
                    $user->setPwd($_POST["pwd"]);
                    $user->setBirthday($_POST["birthday"]);
                    $user->setCountry($_POST["country"]??$user->getCountry());
                    $user->save();
			}else{
				$view->assign("errors", $errors);
			}
		}
		$view->assign("form", $form);
	}
    public function uninstallInstallerAction() {
        session_destroy();
        Secu::deleteInstaller();

//        header('Status: 301 Permanently', false, 301);
        header('Location: /login');
    }

    public function logoutAction(){
        session_destroy();
        setcookie("connectionUser",null,-1);
        setcookie("connectionPWD",null,-1);
        header('Status: 301 Permanently', false, 301);
        header('Location: /login');

	}

	public function forgetPasswordAction() {
        $user = new User();
        $view = new View("forgetPWD",'installer') ;
        $form = $user->formForgetPassword();

        if(!empty($_POST)) {
            if(Secu::userExist($user, $_POST["email"])) {
                $errors = FormValidator::check($form, $_POST);
                if(empty($errors)) {

                    $pwd = uniqid() ;
                    $user->setPwd($pwd) ;
                    $to      = $_POST['email'];
                    $subject = 'JINGO - RESET PASSWORD REQUEST';
                    $url =  $_SERVER["HTTP_ORIGIN"] . "/login" ;
                    $message = "Bonjour, " . PHP_EOL .
                    "Vous venez de nous soumettre une demande de mot de passe oublié." . PHP_EOL .
                    "Afin de pouvoir vous connecter de nouveau, voici votre mot de passe temporaire : <b>" . $pwd ."</b>" . PHP_EOL .
                    " !" . PHP_EOL.
                    "Rendez-vous ici pour vous connecter <b>" . $url . " </b>." ;

                    $id = Database::customSelectFromATable("user","id","email",$_POST['email'],true);
                    $user->setId($id['id']) ;
                    $user->save();


                    Helpers::sendMail($subject,$message,$to);
                } else
                    $view->assign("errors", $errors);

            } else $view->assign("errors",["L'email n'existe pas"]);

        }
        $view->assign("form", $form);

    }



}
