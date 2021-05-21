<?php

namespace App\Core;

use App\Models\User;

class Security
{

	public static function isConnected(){

		return self::checkToken();
	}

    private static function checkToken() {

	    if (isset($_SESSION['user'])) {
            return ($_SESSION['user']->getToken() == $_SESSION['user']->getOneRowWithId('token', $_SESSION['user']->getId()));
        }

	    return false;

    }
    public static function userTestConnection(User $user, String $pwd) {

	    if(self::userExist($user,$user->getEmail())) {
	        $tmp = $user->searchOneColWithOneRow("user","pwd","email",$user->getEmail()) ;
	        if(password_verify($pwd,$tmp['pwd']))
	            return true ;
	        return false ;
        }
    }
    public static function userExist(User $user, String $email): bool {

        $test = $user->countRow("user", "email", "email", $email);
        if ($test == 0) {
            $_SESSION["userExist"] = false;
            return false;
        }
        $_SESSION["userExist"] = true;
        return true;
    }

}