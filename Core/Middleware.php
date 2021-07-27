<?php


namespace App\Core;

class Middleware
{

    /**
     * This method is testing if a lesson exist in context. A lesson is in a part and a part in a training.
     * We're forced to test if a lesson exist in both and testing too Part and Training exist.
     * Moreover it's possible to have two same lesson name in different context so we have to test all case
     * @param String $lessonName
     * @param String $partName
     * @param String $formationName
     * @return bool
     */
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

    /**
     * this method is testing if a part exist in current context. A part is include into a training
     * In many differents trainings a part can exist so we have to verify all training too in which part name is equal
     * @param String $partName
     * @param String $formationName
     * @return bool
     */
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

    /**
     * This method testing if a training is existing
     * @param String $formationName
     * @return bool
     */
    public static function isFormationExist(String $formationName) : bool {
        $formationNameFromDB = Database::customSelectFromATable("training","url","url", Helpers::stringify($formationName),true);
        return !empty($formationNameFromDB) ;

    }

    /**
     * Return Lesson controller name
     * @return string
     */
    public static function getControllerLesson() :string {
        return "Lessons" ;
    }

    /**
     * Return Part controller name
     * @return string
     */
    public static function getControllerPart() :string {
        return "Part" ;
    }

    /**
     * Return Formation controller name
     * @return string
     */
    public static function getControllerFormation() :string {
        return "Training" ;
    }

    /**
     * Return back action name to display Training, part and lessons list
     * @return string
     */
    public static function getAction() :string {
        return "show" ;
    }

    /**
     * Return front action to display Training, part and lessons list
     * @return string
     */
    public static function getFrontAction() :string {
        return 'showFront' ;
    }

    /**
     * Check if Training, Part, Lessons needs connection
     * All TPL doesn't need connection > return false
     * @return bool
     */
    public static function isAuthNeeded() :bool {
        return false ;
    }

    /**
     * Checking if page exist
     * @param String $pageUrl
     * @return bool
     */
    public static function isPageExist(String $pageUrl): bool {
        $exist = Database::customSelectFromATable('page','url','url',$pageUrl,true) ;
        return !empty($exist) ;
    }




}