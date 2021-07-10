<?php


namespace App\Controller;
use App\Core\Database;
use App\Core\View;

class Page
{
    public function createPageAction()
    {
        $view = new View("page", "page");
        $directory = 'Content/Images/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        $img_dir = [];
        foreach ($scanned_directory as $key => $dir) {
            $img_dir[$key + 1] = $directory . $dir;
        }
        $view->assign("img_dir", $img_dir);

        $trainingUrlList = Database::customSelectFromATable('training', 'url');
        $trainingLessonList = Database::customSelectFromATable('lesson', 'url');
        $trainingPartList = Database::customSelectFromATable('part', 'url');
        $createdPagesList = Database::customSelectFromATable('part', 'url'); //liste des pages créer

        //remplacer les liens par les affichages front

        $view->assign("trainingUrlList", $trainingUrlList);
        $view->assign("trainingLessonList", $trainingLessonList);
        $view->assign("trainingPartList", $trainingPartList);



    }
}
