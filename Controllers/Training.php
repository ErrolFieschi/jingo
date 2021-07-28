<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\Training as T;
use App\Models\Part;

class Training
{

    //Suppression Formation
    /**
     *
     */
    public function trainingDeleteAction()
    {
        if (!empty($_GET['id'] && isset($_GET['id']))) {

            $parts = Database::customSelectFromATable('part','*','training_id',$_GET['id']) ;
            $lessons = [] ;
            foreach ($parts as $part) {
                $lessons[] = Database::customSelectFromATable('lesson','*','part_id',$part['id']) ;
            }
            foreach ($lessons as $lesson) {
                Database::deleteFromId('lesson','id',$lesson[0]['id']);
            }
            foreach ($parts as $part) {
                Database::deleteFromId('part','id',$part['id']);
            }

            Database::deleteFromId('training', 'id', $_GET['id']);
        }
        header('Location: /training');
    }

    /**
     * Updating a training
     */
    public function trainingUpdateAction() {
        $view = new View('trainingUpdate','back');
        $train = new \App\Models\Training() ;


        if(!empty($_POST)) {

            if (isset($_POST['id']) ) {
                $training = Database::customSelectFromATable('training', '*', 'id', $_POST['id'], true);

                $form = $train->formTrainingUpdate($training, '/training');
                $view->assign('form', $form);

            }
            if ( isset($_POST['uri'])) {
                $errors = FormValidator::check($form, $_POST);
                if(empty($errors)) {
                    $train->setId($_POST['id']);
                    $train->setTitle(str_replace("'" ,"\'",$_POST['title'] ?? $training['title']));
                    $train->setDescription(str_replace( "'","\'",$_POST['description']??$training['description']));
                    $train->setTrainingTagId($_POST['themes']??$training['training_tag_id']) ;
                    $train->setActive($_POST['active']??$training['active']);
                    $train->setTemplate($_POST['template']??$training['template']);
                    $train->setCreateby($training['createby']);
                    $train->setUrl($training['url']);

                    $train->save();
                    header('Location: /training');
                }else $view->assign('errors', $errors);
            }
        }
    }

    //Afficher ou cacher formation

    /**
     *
     */
    public function trainingVisibleAction()
    {
        if (isset($_GET['visible']) && isset($_GET['id'])) {
            echo "test";
            if ($_GET['visible'] == 1) {
                Database::updateOneRow('training', 'active', 0, 'id', $_GET['id']); // Fonctionne
            } else {
                Database::updateOneRow('training', 'active', 1, 'id', $_GET['id']); // Ne fonctionne pas
            }
        }
        header('Location: /training');
    }

    /**
     *
     */
    public function trainingAction()
    {

        $view = new View("training", "back");

        $training = new T();
        $formTraining = $training->formTraining();

        //Select formation
        $training_table = DBPREFIXE."training";
        $training_tag_table = DBPREFIXE."training_tag";
        $data = $training->globalFind("SELECT $training_table.id as training_id,
        $training_tag_table .id as training_tag_id,
        $training_tag_table .name,
        $training_table.title,
        $training_table.update_date,
        $training_table.active,
        $training_table.duration,
        $training_table.template,
        $training_table.createby,
        $training_table.description,
        $training_table.active,
        $training_table.url,
        $training_table.image
        FROM DBPREFIXE.training LEFT JOIN $training_tag_table
        ON $training_table.training_tag_id = $training_tag_table.id ORDER BY $training_table.update_date", []);
        // ne pas afficher la premiere donnée qui est la donnée référence

        $view->assign("data", $data);

        //Ajout formation
        if (!empty($_POST)) {
            $errors = FormValidator::check($formTraining, $_POST);
            if ($training->countRow('training', 'id', 'title', $_POST["title"]) != 1) {
                if (empty($errors)) {
                    $training->setCreateby($_SESSION['id']);
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

    /**
     *
     */
    public function showAction()
    {
        $uri = Helpers::getUrlAsArray();
        $parts = [];
        $part = new Part();
        $trainingId = Database::customSelectFromATable('training', 'id, title', 'url', $uri[0], true);
        array_push($parts, Database::customSelectFromATable("part", '*', 'training_id', $trainingId['id'], false, 'order_part'));

        $view = new View("part-list", "back");
        $part = new Part();
        $form = $part->formPart();
        $view->assign("data", $parts[0]);
        $view->assign("uri", $uri[0]);
        $view->assign("title", $trainingId['title']);
        $view->assign("trainingId", $trainingId['id']);
        $view->assign("form", $form);

        if (!empty($_POST)) {
            $errors = FormValidator::check($form, $_POST);

            if ($part->countRow('part', 'id', 'title', $_POST["title"]) != 1) {
                if (empty($errors)) {

                //echo '<pre>';
                //var_dump($_POST);
                //echo 'id### ' . $trainingId['id'];
                    $part->setCreateby('user');
                    $part->setTitle($_POST["title"]);
                    $part->setOrderPart(1);
                    $part->setUrl($part->getTitle());
                    $part->setTrainingId($trainingId['id']);

                    $part->save();

                    header("Location: /" . $uri[0]);

                } else {
                    $view->assign("errors", $errors);
                }
            }
        }
    }

    /**
     *
     */
    public function showFrontAction()
    {
        $uri = Helpers::getUrlAsArray();
        $parts = [];

        $trainingId = Database::customSelectFromATable('training', 'id, title', 'url', $uri[1], true);
        array_push($parts, Database::customSelectFromATable("part", '*', 'training_id', $trainingId['id'], false, 'order_part'));

        $view = new View("page-part", "front");
        $part = new Part();

        $form = $part->formPart();
        $view->assign("data", $parts[0]);
        $view->assign("uri", $uri[1]);
        $view->assign("title", $trainingId['title']);
        $view->assign("trainingId", $trainingId['id']);
        $view->assign("form", $form);
    }

    /**
     *
     */
    public function listAction()
    {

        $view = new View("courses", "front");

        $training = new T();

        //Select formation
        $training_table = DBPREFIXE."training";
        $training_tag_table = DBPREFIXE."training_tag";
        $data = $training->globalFind("SELECT $training_table.id as training_id,
        $training_tag_table .id as training_tag_id,
        $training_tag_table .name,
        $training_table.title,
        $training_table.update_date,
        $training_table.active,
        $training_table.duration,
        $training_table.template,
        $training_table.createby,
        $training_table.description,
        $training_table.active,
        $training_table.url,
        $training_table.image
        FROM DBPREFIXE.training LEFT JOIN $training_tag_table
        ON $training_table.training_tag_id = $training_tag_table.id WHERE $training_table.active = 1 ORDER BY $training_table.update_date", []);
        // ne pas afficher la premiere donnée qui est la donnée référence

        $view->assign("data", $data);
    }
}
