<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\Navbar as N;


class Navbar
{

    public function navEditAction(){

        $view = new View("nav-editor", "page");

        $trainingUrlList = Database::customSelectFromATable('training', 'url');
        $trainingLessonList = Database::customSelectFromATable('lesson', 'url');
        $trainingPartList = Database::customSelectFromATable('part', 'url');
        $createdPagesList = Database::customSelectFromATable('page', 'url'); //liste des pages créer
        $getIdNav = Database::customSelectFromATable('navbar', 'id');
        $getNavBar = Database::customSelectFromATable('navbar', '*');

        $view->assign("trainingUrlList", $trainingUrlList);
        $view->assign("trainingLessonList", $trainingLessonList);
        $view->assign("trainingPartList", $trainingPartList);
        $view->assign("createdPagesList", $createdPagesList);
        $view->assign("getNavBar", $getNavBar);

        $nav = new N();
        $saveNav = $nav->updateNavbar();
        if (!empty($_POST)) {
            $errors = FormValidator::check($saveNav, $_POST);
            if (empty($errors)) {
                $nav->setId($getIdNav[0][0]);
                $nav->setCode($_POST['code']);
                $nav->setForm($_POST['form']);
                $nav->save();
            } else {
                var_dump($errors);
            }
        }
        $view->assign("saveNav", $saveNav);

    }

}
