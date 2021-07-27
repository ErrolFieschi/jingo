<?php

namespace App\Core;

use App\Models\User;

class Security
{

	public static function isConnected(){
        if(isset($_SESSION['connected']) && $_SESSION['connected'] == true)
		    return self::checkToken();
        return false ;
	}

    private static function checkToken() {
        //echo "<pre>" ; var_dump($_SESSION);
	    if (isset($_SESSION['token']) && isset($_SESSION['id'])) {
            $bd = Database::getInstance() ;
            $token = $bd->searchOneColWithOneRow("user","token","id",$_SESSION['id']);
            //var_dump($token);
            return ($_SESSION['token'] == $token[0] ) ;
        }

	    return false;

    }
    public static function userTestConnection(User $user, String $pwd) {

	    if(self::userExist($user,$user->getEmail())) {
	        $tmp = $user->searchOneColWithOneRow("user","pwd","email",$user->getEmail()) ;
	        if(password_verify($pwd,$tmp['pwd'])) {
	            $_SESSION['connected'] = true ;
                return true ;
            }

	        return false ;
        }
    }

    public static function userTestConnectionByToken(User $user ,String $token) : bool {
	    return $user->getToken() == $token ;
    }

    public static function userExist(User $user, String $email, String $emailVerif = null): bool {
        $test = $user->countRow("user", "email", "email", $email);
        if ($test == 0 || !empty($emailVerif) && $email == $emailVerif) {
            $_SESSION["userExist"] = false;
            return false;
        }
        $_SESSION["userExist"] = true;
        return true;
    }

    public static function userRole(): String {
        if (self::isConnected()) {
            $role_user = Database::customSelectFromATable('user', 'role', 'id', $_SESSION['id']);
            return $role_user[0]['role'];
        }
    }

    public static function deleteInstaller() {
        try {
            unlink("Core/data.sql") ;
            unlink('Core/Installer.php');
        } catch (\Exception $e){}
    }

}
