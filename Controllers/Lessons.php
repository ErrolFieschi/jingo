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

//    public function displayAction(){
//        $lesson = Database::customSelectFromATable('lesson', 'id, code', 'id', $_POST['id'], true);
//        echo $lesson['code'];
//    }
    public function showFrontAction(){
        $uri = Helpers::getUrlAsArray();
        var_dump($uri);
        exit();
        $lesson = Database::customSelectFromATable('lesson', '*', 'url', $uri[2], true);

        $view = new View("lesson", "front");
        $view->assign("lesson", $lesson);
        $view->assign("chapitre", $uri[2]);
        $view->assign("back", $uri[0] . '/' . $uri[1]);
    }
}

