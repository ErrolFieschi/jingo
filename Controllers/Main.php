<?php

namespace App\Controller;

use App\Core\FormValidator;
use App\Core\View;
use App\Models\Lesson;
use App\Models\User;

class Main{

	public function statsAction(){

		$view = new View("stats","back");
	}

	public function settingsAction(){

        $view = new View("settings", "back");
        $user = new User() ;

        $form = $user->formPWDChange() ;
        if(!empty($_POST)) {
            $errors = FormValidator::check($form, $_POST);
            if(empty($errors)) {
                if( isset($_POST["oldPwd"]) && isset($_POST["pwd"]) && isset($_POST["pwdConfirm"])) {
                    $user->setId($_SESSION["id"]) ;
                    $tmp = $user->searchOneColWithOneRow("user","pwd","id",$user->getId()) ;

                    if(password_verify($_POST["oldPwd"],$tmp['pwd'])) {
                        $user->setPwd($_POST["pwd"]);
                        $user->setToken();
                        $user->save();
                        $_SESSION['token'] = $user->getToken() ;
                        setcookie("connectionUser",  $user->getToken() ,time()+3600*24) ;

                        $success [] = "Mot de passe mise à jour" ;
                        $view->assign("success", $success);
                    } else {
                        $errors [] = "Ancien mot de passe incorrect" ;
                        $view->assign("errors", $errors);
                    }
                }
            } else
                $view->assign("errors", $errors);
        }


        $view->assign("form",$form);
    }

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $formLesson = $lesson->formLesson();



        $view->assign("formLesson", $formLesson);
    }

    public function usersAction(){

        $view = new View("users", "back");
    }
}
