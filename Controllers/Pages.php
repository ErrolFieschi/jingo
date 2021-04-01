<?php


namespace App\Controller;
use App\Core\View;


class Pages
{
    public function defaultAction(){

        $view = new View("pages");
    }

    public function pagesAction(){

        $view = new View("pages","back");
    }

}
