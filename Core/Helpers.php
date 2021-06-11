<?php

namespace App\Core;

class Helpers
{

    public static function stringify(String $string) : string {
        $string = mb_strtolower($string) ;
        $string = str_replace(" ","_",$string) ;
        $string = self::remove_accents($string) ;

        return $string ;
    }

    public static function remove_accents($str, $charset='utf-8') :string
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
        $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#\&[^;]+\;#', '', $str); // supprime les autres caractères

        return $str;
    }

    public static function generateUrl(String $id, String $url) :string {
        return $id . "-" . $url ;
    }

    public static function generateUrlAndSave($object)  {
        $class = explode("\\",get_class($object));
        $class = mb_strtolower($class[2]) ;

        if($class != "training" || $class != "part" || $class != "lesson") {
            $id = Database::customSelectOneFromATable("$class","id","title",$object->getTitle());
            $object->setId($id['id']) ;
            $object->setUrl(self::generateUrl($object->getId(),$object->getUrl()));
            $object->save();
        }
    }

    public static function getUrlAsArray() {
       // $uri = substr($_SERVER["REQUEST_URI"],1) ;
        return explode("/",substr($_SERVER["REQUEST_URI"],1) ) ;
    }

}