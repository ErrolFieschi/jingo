<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\View;
use App\Core\FormValidator;

use App\Models\Part as P;


class Part
{

    public function showAction(){
        $uri = Helpers::getUrlAsArray();
        $lessons = [];

        $trainingId = Database::customSelectFromATable('training', 'id', 'url', $uri[0], true);
        //var_dump($trainingId['id']);
        //echo '<br>';

        $parts = Database::customSelectFromATable('part', 'id', 'training_id', $trainingId['id'], true);
        //var_dump($parts['id']);

        //foreach ($parts as $part){
            array_push($lessons, Database::customSelectFromATable("lesson", 'id,title,resume,image,url', 'part_id', $parts['id']));
        //}
        //echo 'COUNT## ' . count($lessons[0]);

        //echo '<pre>';
        //var_dump($lessons[0]);
        $view = new View("lesson-list", "back");
        $view->assign("data", $lessons[0]);
    }
}