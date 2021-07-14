<?php


namespace App\Core;

class Middleware
{
    public static function isLessonExist(String $lessonName, String $partName, String $formationName) : bool {

        $exist = Database::customSelectFromATable("lesson","url, part_id","url",Helpers::stringify($lessonName),true);
        if(! empty($exist)) {
            $partNameFromDB = Database::customSelectFromATable("part","url, training_id","id",$exist['part_id'],true);
            if(!empty($partNameFromDB)) {
                $formationNameFromDB = Database::customSelectFromATable("training","url","id",$partNameFromDB['training_id'],true);
                if(!empty($formationNameFromDB)) {
                    if($formationName == Helpers::stringify($formationNameFromDB['url']))
                        if(self::isFormationExist($formationNameFromDB['url']))
                            if($partName == Helpers::stringify($partNameFromDB['url']))
                                if(self::isPartExist($partName,$formationNameFromDB['url']))
                                    return true ;
                }
            }
        }
        return false ;
    }

    public static function isPartExist(String $partName, String $formationName) : bool {

        $exist =  Database::customSelectFromATable("part","url, training_id","url",$partName,true);
        if(!empty($exist)) {
            $formationNameFromDB = Database::customSelectFromATable("training","url","id", $exist['training_id'],true);
            if(!empty($formationNameFromDB))
                if(Helpers::stringify($formationName) == Helpers::stringify($formationNameFromDB['url'])) {
                    return true ;
                }
        } return false ;

    }

    public static function isFormationExist(String $formationName) : bool {
        $formationNameFromDB = Database::customSelectFromATable("training","url","url", Helpers::stringify($formationName),true);
        return !empty($formationNameFromDB) ;

    }

    public static function getControllerLesson() :string {
        return "Lessons" ;
    }
    public static function getControllerPart() :string {
        return "Part" ;
    }
    public static function getControllerFormation() :string {
        return "Training" ;
    }

    public static function getAction() :string {
        return "show" ;
    }

    public static function isAuthNeeded() :bool {
        return false ; // ON NE GERE PAS POUR LE MOMENT
    }


}