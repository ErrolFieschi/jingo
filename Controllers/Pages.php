<?php

namespace App\Controller;

use App\Core\Helpers;
use App\Core\View;
use App\Core\FormValidator;
use App\Models\Lesson;
use App\Core\Database;


class Pages
{

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $form = $lesson->formLesson();

        if(!empty($_POST)){
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
                $lesson->setUrl($lesson->getTitle());
                $lesson->save();

                Helpers::generateUrlAndSave($lesson) ;

                //header('Location: /training');

            }else{
                $view->assign("errors", $errors);
            }
        }
        $view->assign("form", $form);
    }

    public function lessonListAction(){

           if(isset($_GET['id'])){
            $lesson = new Lesson();
            $data = $lesson->getRowWithId($_GET['id']) ;
            $lesson = new Lesson();
            $form = $lesson->formLesson();

            //$training =
            $view = new View("lesson-list", "back");
            $view->assign("data", $data);
            $view->assign("form", $form);


            if(!empty($_POST)){
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


                    echo "test" ;
                    header('Location: /training');

                }else{
                    $view->assign("errors", $errors);
                }
            }
        }else{
            header('Location: /training');
        }
    }

    public function showAction(){
        $uri = Helpers::getUrlAsArray();

        $lesson = Database::customSelectFromATable('lesson', '*', 'url', $uri[2], true);

        $view = new View("lesson", "back");
        $view->assign("lesson", $lesson);
        $view->assign("chapitre", $uri[2]);
        $view->assign("back", $uri[0] . '/' . $uri[1]);

    }

    public function deleteLesson(){
        echo "<script>console.log('test');</script>";
    }
}

