<?php

namespace App\Controller;

use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker as c;
use App\Models\Lesson;


class Pages
{

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $form = $lesson->formLesson();



        if(!empty($_POST)){

            $errors = FormValidator::check($form, $_POST);

            if(empty($errors)){

                $lesson->setCreateby('user');
                $lesson->setTitle($_POST["title"]);
                $lesson->setIcon($_POST["icon"]);
                $lesson->setCode($_POST["code"]);
                $lesson->setPartId(1);
                $lesson->save();

            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("form", $form);
    }




}
