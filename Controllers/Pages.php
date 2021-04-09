<?php


namespace App\Controller;
use App\Core\FormValidator;
use App\Core\View;
use App\Models\Page;

class Pages
{

    public function pagesAction(){

        $view = new View("pages","back");
        $page = new Page();
        $form = $page->addPages();
        if(!empty($_POST)){

            $errors = FormValidator::check($form, $_POST);

            if(empty($errors)){

                $page->setName($_POST["name"]);
                $page->setTitle($_POST["title"]);
                $page->createPage(); //remplacer par une fonction file_puts_content

            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("form", $form);
    }

}
