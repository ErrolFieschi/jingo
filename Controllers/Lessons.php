<?php

namespace App\Controller;

use App\Core\Helpers;
use App\Core\View;
use App\Core\Database;
use App\Models\Lesson;


class Lessons
{

    public function showAction(){
        $uri = Helpers::getUrlAsArray();
        $lesson = Database::customSelectFromATable('lesson', '*', 'url', $uri[2], true);

        $view = new View("lesson", "back");
        $view->assign("lesson", $lesson);
        $view->assign("chapitre", $uri[2]);
        $view->assign("back", $uri[0] . '/' . $uri[1]);
    }

    public function deleteLessonAction(){
        Database::deleteFromId("lesson", "id", $_POST['id']);
        header('Location: ' . $_POST['uri']);
    }

    public function displayAction(){
        $lesson = Database::customSelectFromATable('lesson', 'id, code', 'id', $_POST['id'], true);
        echo $lesson['code'];
    }

    public function showFrontAction(){
        $uri = Helpers::getUrlAsArray();
        $lesson = Database::customSelectFromATable('lesson', '*', 'url', $uri[2], true);

        $view = new View("lesson", "front");
        $view->assign("lesson", $lesson);
        $view->assign("chapitre", $uri[2]);
        $view->assign("back", $uri[0] . '/' . $uri[1]);
    }

    public function searchAction(){

        if (isset($_POST['query'])) {
            $inpText = htmlspecialchars($_POST['query']);
            $partId = htmlspecialchars($_POST['checkId']);
            $uri = htmlspecialchars($_POST['uri']);
            $lesson = new Lesson();
            $lesson = $lesson->globalFind('SELECT id, title, url FROM wlms_lesson WHERE title LIKE :value AND part_id = :partId', ['value' => '%'.$inpText.'%', 'partId' => $partId]);

            if ($lesson) {
                foreach ($lesson as $row) {
                    echo '<a href="'. '/' . $uri . '/' .$row['url'] .'" class="list-group-item list-group-item-action border-1" style="padding: 15px 0;">' . $row['title'] . '</a>';
                }
            } else {
                echo '<p class="list-group-item border-1">Aucune leçon trouvée</p>';
            }
        }
    }
}

