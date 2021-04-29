<?php

namespace App\Controller;

use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker as c;

use App\Models\Lesson;

class Training{

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $formLesson = $lesson->formLesson();


        if(!empty($_POST)){

            $errors = FormValidator::check($formLesson, $_POST);

            if(empty($errors)){

                $lesson->setTitle($_POST["title"]);
                $lesson->setDescription($_POST["description"]);
                $lesson->setTags($_POST["tags"]);
                $lesson->save();

            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("formLesson", $formLesson);
    }
}
