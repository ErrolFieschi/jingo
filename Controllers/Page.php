<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\Page as P;


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
        $createdPagesList = Database::customSelectFromATable('page', 'url'); //liste des pages créer

        //remplacer les liens par les affichages front

        $view->assign("trainingUrlList", $trainingUrlList);
        $view->assign("trainingLessonList", $trainingLessonList);
        $view->assign("trainingPartList", $trainingPartList);

    }


    public function showPagesAction()
    {
        $view = new View("pages", "back");
        $pagesShow = Database::customSelectFromATable('page', '*');
        $view->assign("pagesShow", $pagesShow);

        $page = new P();
        $addPage = $page->createPage();

        if (!empty($_POST)) {
            $errors = FormValidator::check($addPage, $_POST);
            if ($page->countRow('page', 'id', 'title', $_POST["title"]) != 1) {
                if (empty($errors)) {
                    $page->setCreateBy($_SESSION['id']);
                    $page->setActive(1);
                    $page->setTitle($_POST["title"]);
                    $page->setUrl($page->getTitle());
                    $page->setName($_POST["name"]);
                    $page->setMeta($_POST["meta"]);
                    $page->setVisible($_POST['visible']);

                    $page->save();

                } else {
                    $page->setId($_POST['id']);
                    $page->setCreateBy(1);
                    $page->setActive(1);
                    $page->setUrl($page->getTitle());
                    $page->setUrl($_POST["name"]);
                    $page->setName($_POST["name"]);
                    $page->setMeta($_POST["meta"]);
                    $page->setVisible($_POST['visible']);

                    $page->save();
                }
            } else {
                $view->assign("errors", $errors);
            }
        }
        $view->assign("addPage", $addPage);
    }

    public function renderPageAction()
    {
        $uri = Helpers::getUrlAsArray();
        $view = new View("page-show", "front");
        $pagesShow = Database::customSelectFromATable('page', '*', 'url', $uri[1]);
        $view->assign("pagesShow", $pagesShow);
    }

    public function updatePageAction()
    {
        $view = new View("page-update", "page");
        $directory = 'Content/Images/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        $img_dir = [];
        foreach ($scanned_directory as $key => $dir) {
            $img_dir[$key + 1] = $directory . $dir;
        }
        $trainingUrlList = Database::customSelectFromATable('training', 'url');
        $trainingLessonList = Database::customSelectFromATable('lesson', 'url');
        $trainingPartList = Database::customSelectFromATable('part', 'url');
        $createdPagesList = Database::customSelectFromATable('page', 'url'); //liste des pages créer
        $view->assign("img_dir", $img_dir);
        $view->assign("trainingUrlList", $trainingUrlList);
        $view->assign("trainingLessonList", $trainingLessonList);
        $view->assign("trainingPartList", $trainingPartList);
        $pagesShow = Database::customSelectFromATable('page', '*', 'id', $_GET["id"]);
        $view->assign("pagesShow", $pagesShow);


        $page = new P();
        $savePage = $page->savePage();
        if (!empty($_POST)) {
            $errors = FormValidator::check($savePage, $_POST);
            if (empty($errors)) {
                $page->setId($_GET['id']);
                $page->setCode($_POST['code']);
                $page->setCreateBy(1);
                $page->setActive(1);
                $page->save();
            } else {
                var_dump($errors);
            }
        }
        $view->assign("savePage", $savePage);
    }


}