<?php

namespace App\Controller;

use App\Core\View;
use App\Core\FormValidator;
use App\Models\Lesson;


class Pages
{

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $form = $lesson->formLesson();

        if(!empty($_POST)){


            var_dump($_FILES);
            //echo "<script>console.log('h1')</script>";
            $errors = FormValidator::check($form, $_POST, $_FILES);

            if(empty($errors)){

                $picture_name = 'lesson-photo-' . date('Y-m-d-H-i-s');
                $filename = basename($_FILES["photo"]["name"]);
                $temp_array = explode(".", $filename);
                $extension = end($temp_array);
                $link = 'Content/Images/lesson/' . $picture_name . '.' . $extension;
                move_uploaded_file($_FILES["photo"]["tmp_name"], $link);

                $lesson->setCreateby('user');
                $lesson->setTitle($_POST["title"]);
                $lesson->setResume($_POST["resume"]);
                $lesson->setIcon($_POST["icon"]);
                $lesson->setImage($link);
                $lesson->setCode($_POST["code"]);
                $lesson->setPartId(1);
                $lesson->save();

                header('Location: /training');

            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("form", $form);
    }

    public function testAction() {
        echo "CA MARCHE GG" ;
    }

    public function lessonListAction(){

           if(isset($_GET['id'])){
            $lesson = new Lesson();
            $data = $lesson->getRowWithId($_GET['id']) ;

            //$training =
            $view = new View("lesson-list", "back");
            $view->assign("data", $data);
        }else{
            header('Location: /training');
        }

    }

    public function importAction(){

    }
}

