<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\View;
use App\Core\FormValidator;
use App\Models\Library as Lib;

class Library
{
    public function libraryAction()
    {
        $view   = new View("library","front");
        $lessons = [];
        array_push($lessons, Database::customSelectFromATable("lesson", 'id,title,resume,image,url', 'part_id', 2));

        $view->assign("lessons", $lessons[0]);
        $images = new Lib();

        $formImage = $images->formImage();
//
//        $filename = basename($_FILES["photo"]["name"]);
//        $temp_array = explode(".", $filename);
//        $extension = end($temp_array);
//        $link = 'Content/Images/lesson/';
//
//        $view->assign('$formImage', $formImage);

    }
}