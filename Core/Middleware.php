<?php


namespace App\Core;


use App\Models\Lesson;

class Middleware
{
    public static function isLessonExist(String $lessonName) : bool {
        $lesson = new Lesson() ;
        $exist = $lesson->searchOneColWithOneRow("lesson","title","title",$lessonName);
        return !empty($exist) ;
    }
    public static function isPartExist(String $partName) : bool {
        return true ;
    }
    public static function isFormationExist(String $formationName) : bool {
        return true ;
    }

    public static function getControllerLesson() :string {
        return "Pages" ;
    }
    public static function getControllerPart() :string {
        return "Part" ;
    }
    public static function getControllerFormation() :string {
        return "Formation" ;
    }

    public static function getAction() :string {
        return "test" ;
    }

    public static function isAuthNeeded() :bool {
        return false ; // ON NE GERE PAS POUR LE MOMENT
    }

}