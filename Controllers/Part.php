<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Helpers;
use App\Core\View;
use App\Core\FormValidator;

use App\Models\Lesson;
use App\Models\Part as P;


class Part
{
    public function showAction(){
        $uri = Helpers::getUrlAsArray();
        $lessons = [];

        $parts = Database::customSelectFromATable('part', 'id', 'url', $uri[1], true);
        array_push($lessons, Database::customSelectFromATable("lesson", 'id,title,resume,image,url', 'part_id', $parts['id']));

        $view = new View("lesson-list", "back");
        $lesson = new Lesson();
        $form = $lesson->formLesson();
        $view->assign("data", $lessons[0]);
        $view->assign("uri", $uri[1]);
        $view->assign("back", $uri[0]);
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

                    //echo '<pre>';
                    var_dump($_POST['code']);
                    exit;
                    $lesson->setCreateby('user');
                    $lesson->setTitle($_POST["title"]);
                    $lesson->setResume($_POST["resume"]);
                    $lesson->setIcon($_POST["icon"]);
                    $lesson->setImage($link);
                    $lesson->setUrl($lesson->getTitle());
                    $lesson->setCode($_POST["code"]);
                    $lesson->setPartId($parts['id']);
                    $lesson->save();
                    //var_dump($lesson);

                    header("Location: /" . $uri[0] . '/' . $uri[1]);

                }else{
                    $view->assign("errors", $errors);
                }
            }
    }
}