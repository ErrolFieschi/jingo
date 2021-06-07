<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Lesson;

class Main{

	public function statsAction(){

		$view = new View("stats","back");
	}

	public function settingsAction(){

        $view = new View("settings", "back");
    }

    public function lessonAction(){

        $view = new View("lesson", "back");
        $lesson = new Lesson();

        $formLesson = $lesson->formLesson();



        $view->assign("formLesson", $formLesson);
    }
}
