<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\View;
use App\Models\Lesson;
use App\Models\User;

class Main{

	public function statsAction(){

		$view = new View("stats","back");

        $userCtrl = new User();

        $view->assign('nbUsers', $userCtrl->countRowWithoutCondition('user')[0]);
        $view->assign('nbPages', $userCtrl->countRowWithoutCondition('page')[0]);
        $view->assign('nbTrainings', $userCtrl->countRowWithoutCondition('training')[0]);
        $view->assign('nbLessons', $userCtrl->countRowWithoutCondition('lesson')[0]);

        $users = $userCtrl->customSelectFromATable('user', '*');
        
        $arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

        foreach($arr as $index) {
            $usersByDate[$index] = 0;
        }

        foreach($users as $user) {
            $usersByDate[(int) date('m', strtotime($user['createdAt']))]++;
        }

        $view->assign('usersByDate', $usersByDate);

        $trainingsByTag = $userCtrl->innerJoinGroupBy('training', 'training_tag', 'training_tag_id', 'name');

        foreach($trainingsByTag as $key => $trainingByTag) {
            $trainingsByTagName[$key] = $trainingByTag[0];
            $trainingsByTagData[$key] = $trainingByTag[1];
        }
        
        $view->assign('trainingsByTagName', $trainingsByTagName);
        $view->assign('trainingsByTagData', $trainingsByTagData);
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
}
