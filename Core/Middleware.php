<?php


namespace App\Core;

class Middleware
{
    public static function isLessonExist(String $lessonName, String $partName, String $formationName) : bool {

        $test=[];
        $exist = Database::customSelectFromATable("lesson","url, part_id","url",Helpers::stringify($lessonName));
        $ids = [] ;
        foreach ($exist as $id) {
            $ids[] = $id['part_id'] ;
        }
        if(! empty($exist)) {
            $partsId = [] ;
            $parts=[];
            foreach ($ids as $id) {
                $part = Database::customSelectFromATable("part","url, training_id","id",$id);
                foreach ($part as $value) {
                    $partsId[]=$value['training_id'] ;
                    $parts[]=Helpers::stringify( $value['url'] );
                }
            }
            if(!empty($parts)) {
                $formations=[] ;
                foreach ($partsId as $part) {
                    $formationNameFromDB = Database::customSelectFromATable("training","url","id",$part['training_id']);
                    foreach ($formationNameFromDB as $training) {
                        if( !in_array( Helpers::stringify($training['url']) ,$formations ) ) {
                            $formations[] = Helpers::stringify( $training['url'] );
                        }
                    }
                }
                if(!empty($formations)) {
                    if(in_array(Helpers::stringify($formationName),$formations)) {
                        foreach ($formations as $formation) {
                            if(self::isFormationExist($formation)) {
                                if(in_array(Helpers::stringify($partName),$parts)) {
                                    if(self::isPartExist($partName,$formation)) {
                                       $test[] = true ;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return in_array(true,$test) ;
    }

    public static function isPartExist(String $partName, String $formationName) : bool {

        $exist =  Database::customSelectFromATable("part","url, training_id","url",$partName);
        $ids = [];
        foreach ($exist as $id) {
            $ids[] = $id['training_id'] ;
        }
        if(!empty($exist)) {
            $formations=[];
            foreach ($ids as $value) {
                $formationNameFromDB = Database::customSelectFromATable("training","url","id", $value);
                $formations[] = Helpers::stringify($formationNameFromDB[0]['url']) ;
            }

            if(!empty($formations)) {
                if(in_array(Helpers::stringify($formationName),$formations)) {
                    return true ;
                }
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

    public static function getFrontAction() :string {
        return 'showFront' ;
    }

    public static function isAuthNeeded() :bool {
        return false ; // ON NE GERE PAS POUR LE MOMENT
    }

    public static function isPageExist(String $pageUrl): bool {
        $exist = Database::customSelectFromATable('page','url','url',$pageUrl,true) ;
        return !empty($exist) ;
    }




}