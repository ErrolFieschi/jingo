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

        $data = $training->globalFind('SELECT * FROM wlms_training LEFT JOIN wlms_training_tag ON wlms_training.training_tag_id = wlms_training_tag.id',[]);
        $view->assign("data", $data);

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

}
