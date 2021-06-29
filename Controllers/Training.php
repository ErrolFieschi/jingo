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

                Helpers::generateUrlAndSave($training) ;
            }
            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("formTraining", $formTraining);
    }

    public function showAction(){
        $data = Database::customSelectOneFromATable('training', '*', 'url', ltrim($_SERVER["REQUEST_URI"], "/"));
        //var_dump($data);
        $parts = Database::customSelectFromATable('part', '*', 'training_id', $data['id']);
        echo ltrim($_SERVER["REQUEST_URI"], "\\");

        $lessons = [];
        foreach ($parts as $part){
            array_push($lessons, Database::customSelectFromATable("lesson", '*', 'part_id', $part['id']));
        }

        var_dump($lessons);
    }

}
