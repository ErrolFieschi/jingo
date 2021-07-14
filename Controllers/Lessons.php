<?php

namespace App\Controller;

use App\Core\Helpers;
use App\Core\View;
use App\Core\Database;


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
}

