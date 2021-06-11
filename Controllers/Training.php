<?php


namespace App\Controller;

use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\Training as T;

class Training
{
    public function trainingAction(){

        $view = new View("training", "back");
        $training = new T();

        $formTraining = $training->formTraining();



        if(!empty($_POST)){

            $errors = FormValidator::check($formTraining, $_POST);
            if($training->countRow('training','id','title',$_POST["title"]) != 1){
            if(empty($errors) ){

                $training->setCreateby(1);
                $training->setTitle($_POST["title"]);
                $training->setDescription($_POST['description']);
                $training->setRole(1);
                $training->setUrl($training->getTitle());
                $training->save();

            }
            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("formTraining", $formTraining);
    }

    public function testAction(){
        echo 'GG CA MARCHE' ;
    }

}
