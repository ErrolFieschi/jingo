<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\Training as T;

class Training
{
    public function trainingOptionsAction()
    {
        $view = new View("training", "back");
        $training = new T();


        if (!empty($_GET['id']) && !isset($_GET['visible'])) {
            Database::deleteFromId('training', 'id', $_GET['id']);
        }
        if (!empty($_GET['visible'])) {
            if ($_GET['visible'] == 1) {
                Database::updateOneRow('training', 'active', 0,'id', $_GET['id']); // Fonctionne
                //$training->setActive(0);
                //$training->save();
            } else {
                Database::updateOneRow('training', 'active', 1,'id', $_GET['id']); // Ne fonctionne pas
                //$training->setActive(1);
                //$training->save();
            }
        }
        //header('Location: /training');
    }


    public function trainingAction()
    {

        $view = new View("training", "back");
        $training = new T();

        $formTraining = $training->formTraining();


        $data = $training->globalFind('SELECT wlms_training.id as training_id,
        wlms_training_tag.id as training_tag_id,
        wlms_training_tag.name,
        wlms_training.title,
        wlms_training.update_date,
        wlms_training.active,
        wlms_training.duration,
        wlms_training.template,
        wlms_training.createby,
        wlms_training.description,
        wlms_training.active,
        wlms_training.url,
        wlms_training.image
        FROM wlms_training LEFT JOIN wlms_training_tag 
        ON wlms_training.training_tag_id = wlms_training_tag.id ORDER BY wlms_training.update_date', []);

        $view->assign("data", $data);


        if (!empty($_POST)) {
            $errors = FormValidator::check($formTraining, $_POST);
            if ($training->countRow('training', 'id', 'title', $_POST["title"]) != 1) {
                if (empty($errors)) {
                    $training->setCreateby(1);
                    $training->setTitle($_POST["title"]);
                    $training->setDescription($_POST['description']);
                    $training->setTrainingTagId($_POST['themes']);
                    $training->setTemplate($_POST['template']);
                    $training->setRole(1);
                    if (empty($_POST['visible'])) {
                        $training->setActive(1);
                    } else {
                        $training->setActive($_POST['visible']);
                    }
                    $training->setUrl($training->getTitle());
                    $training->save();

                } else {
                    var_dump($errors);
                }
            } else {
                $view->assign("errors", $errors);
            }
        }
        $view->assign("formTraining", $formTraining);

    }

    public function showAction(){
        $uri = Helpers::getUrlAsArray();
        $parts = [];

        $trainingId = Database::customSelectFromATable('training', 'id', 'url', $uri[0], true);
        //var_dump($trainingId['id']);
        //echo '<br>';

        //foreach ($parts as $part){
        array_push($parts, Database::customSelectFromATable("part", '*', 'training_id', $trainingId['id']));
        //}
        //echo 'COUNT## ' . count($lessons[0]);

        //echo '<pre>';
        //var_dump($lessons[0]);
        $view = new View("part-list", "back");
        $view->assign("data", $parts[0]);
        $view->assign("uri", $uri[0]);
    }




}
