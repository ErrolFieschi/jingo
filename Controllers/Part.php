<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\View;
use App\Core\FormValidator;

use App\Models\Lesson;
use App\Models\Part as P;


class Part
{
    public function showAction(){
        $uri = Helpers::getUrlAsArray();
        $lessons = [];

        $parts = new P();
        $training = Database::customSelectFromATable('training', 'id, title', 'url', $uri[0], true);
        $table = DBPREFIXE . 'part' ;
        $parts = $parts->globalFind('SELECT id, title FROM '.$table.' WHERE url = :url AND training_id = :training_id', ['url' => $uri[1], 'training_id' =>$training['id']]);
        array_push($lessons, Database::customSelectFromATable("lesson", 'id,title,resume,image,url', 'part_id', $parts[0]['id']));

        $view = new View("lesson-list", "back");
        $lesson = new Lesson();
        $form = $lesson->formLesson();

        $view->assign("data", $lessons[0]);
        $view->assign("uri", $uri[1]);
        $view->assign("back", $uri[0]);
        $view->assign("partId", $parts[0]['id']);
        $view->assign("title", $parts[0]['title']);
        $view->assign("form", $form);


            if(!empty($_POST)){
                $errors = FormValidator::check($form, $_POST, $_FILES);

                if(empty($errors)){
                    $picture_name = 'lesson-photo-' . date('Y-m-d-H-i-s');
                    $filename = basename($_FILES["photo"]["name"]);
                    $temp_array = explode(".", $filename);
                    $extension = end($temp_array);
                    $link = 'Content/Images/lesson/' . $picture_name . '.' . $extension;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $link);

                    $lesson->setCreateby('user');
                    $lesson->setTitle($_POST["title"]);
                    $lesson->setResume($_POST["resume"]);
                    $lesson->setImage($link);
                    $lesson->setUrl($lesson->getTitle());
                    $lesson->setCode($_POST["code"]);
                    $lesson->setPartId($parts[0]['id']);

                    $lesson->save();

                    header("Location: /" . $uri[0] . '/' . $uri[1]);

                }else{
                    $view->assign("errors", $errors);
                }
            }
    }

    public function showFrontAction(){
        $uri = Helpers::getUrlAsArray();
        $lessons = [];

        $parts = new P();
        $training = Database::customSelectFromATable('training', 'id, title', 'url', $uri[1], true);
        $t = DBPREFIXE . 'part' ;
        $parts = $parts->globalFind('SELECT id, title FROM '.$t.' WHERE url = :url AND training_id = :training_id', ['url' => $uri[2], 'training_id' =>$training['id']]);
        array_push($lessons, Database::customSelectFromATable("lesson", 'id,title,resume,image,url', 'part_id', $parts[0]['id']));
        $code = Database::customSelectFromATable('lesson', 'id, code', 'id', $lessons[0][0]['id']);

        $view = new View("library", "front");
        $lesson = new Lesson();
        $form = $lesson->formLesson();

        $view->assign("data", $lessons[0]);
        $view->assign("displayCode", $code[0]['code']);
        $view->assign("uri", $uri[2]);
        $view->assign("back", $uri[1]);
        $view->assign("title", $parts[0]['title']);
        $view->assign("form", $form);
    }

    public function updateLessonAction(){

        $view = new View("lesson-update", "back");
        $lesson = new Lesson();
        $form = $lesson->formUpdateLesson($_POST["update"], $_POST['uri']);
        $view->assign("form", $form);
        $view->assign("uri", $_POST['uri']);

        if(!empty($_POST) && !isset($_POST['update'])){

            $lesson->setTitle($_POST["title"]);
            $lesson->setResume($_POST["resume"]);
            $lesson->setCode($_POST["code"]);
            $lesson->setId($_POST["id"]);
            $lesson->save();

            header('Location: ' . $_POST['uri']);
        }
    }

    public function sortPartAction(){
        $orderlist = explode(',', $_POST['order']);

        foreach ($orderlist as $k => $order) {
            Database::updateOneRow('part', 'order_part', $k, 'id', $order);
            echo 'La sauvegarde a bien été effectuée !';
        }
    }

    public function searchAction(){

        if (isset($_POST['query'])) {
            $inpText = htmlspecialchars($_POST['query']);
            $trainingId = htmlspecialchars($_POST['checkId']);
            $uri = htmlspecialchars($_POST['uri']);
            $part = new Lesson();
            $talbe = DBPREFIXE . 'part' ;
            $part = $part->globalFind('SELECT id, title, url FROM '.$talbe .' WHERE title LIKE :value AND training_id = :trainingId', ['value' => '%'.$inpText.'%', 'trainingId' => $trainingId]);

            if ($part) {
                foreach ($part as $row) {
                    echo '<a href="'. '/' . $uri . '/' .$row['url'] .'" class="list-group-item list-group-item-action border-1" style="padding: 15px 0;">' . $row['title'] . '</a>';
                }
            } else {
                echo '<p class="list-group-item border-1">Aucun chapitre trouvé</p>';
            }
        }
    }


    public function deletePartAction(){
        Database::deleteFromId("lesson", "part_id", $_POST['id']);
        Database::deleteFromId("part", "id", $_POST['id']);

        header('Location: ' . $_POST['uri']);
    }
}