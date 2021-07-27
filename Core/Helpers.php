<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class Helpers
{

    /**
     * Stringify string
     * This method transform Title into valid url for Training / pages / part and lesson
     * It removes also accented char and replace by none accented
     * @param String $string
     * @return string
     */
    public static function stringify(String $string) : string {
        $string = mb_strtolower($string) ;
        $string = str_replace(" ","_",$string) ;
        $string = self::remove_accents($string) ;

        return $string ;
    }

    /**
     * This method replace accented char by none accented
     * @param $str
     * @param string $charset
     * @return string
     */
    public static function remove_accents($str, $charset='utf-8') :string
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
        $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#\&[^;]+\;#', '', $str); // supprime les autres caractères

        return $str;
    }

    /**
     * Generate url for lesson
     * @param String $id
     * @param String $url
     * @return string
     */
    public static function generateUrl(String $id, String $url) :string {
        return $id . "-" . $url ;
    }

    /**
     * Generate Url after creating lesson cuz we need ID inside
     * @param $object
     */
    public static function generateUrlAndSave($object)  {
        $class = explode("\\",get_class($object));
        $class = mb_strtolower($class[2]) ;

        if($class != "training" || $class != "part" || $class != "lesson") {
            $id = Database::getLastInsertId() ;
            $object->setId($id) ;
            $object->setUrl(self::generateUrl($object->getId(),$object->getUrl()));
            $object->save();
        }
    }

    /**
     * Split uri into array and return it
     * @return false|string[]
     */
    public static function getUrlAsArray() {
       // $uri = substr($_SERVER["REQUEST_URI"],1) ;
        return explode("/",substr($_SERVER["REQUEST_URI"],1) ) ;
    }

    /**
     * This method send a email to someone
     * @param String $objet
     * @param String $contenu
     * @param String $destinataire
     * @throws Exception
     */
    public static function sendMail(String $objet, String $contenu , String $destinataire) {

        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 0;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = MAIL;
        $mail->Password = MAILPWD;
        //If SMTP requires TLS encryption then set it
        //$mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->From = MAIL;
        $mail->FromName = "Jingo";

        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        $mail->addAddress($destinataire, "Recepient Name");

        $mail->isHTML(true);

        $mail->Subject = $objet;
        $mail->Body = $contenu;
        $mail->AltBody = "This is the plain text version of the email content";

        if(!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            header('Status: 301 Permanently', false, 301);
            header('Location: /login');
        }
    }


    static function extractKeywords($str) {
        $min_word_length = 3;
        $strip_arr = ["," ,"." ,";" ,":", "\"", "'", "“","”","(",")", "!","?"];
        $str_clean = str_replace( $strip_arr, "", $str);
        $str_arr = explode(' ', $str_clean);
        $clean_arr = [];
        foreach($str_arr as $word) {
            if(strlen($word) > $min_word_length) {
                $word = strtolower($word);
                $clean_arr[] = $word;
            }
        }
        return implode(',', $clean_arr);
    }

}