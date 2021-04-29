<?php

namespace App\Core;

use App\Models\User;

class Security
{

	public static function isConnected(){

        echo "Connecter !";

		return self::checkToken();
	}

    private static function checkToken() {

	    if (isset($_SESSION['user'])) {
            return ($_SESSION['user']->getToken() == $_SESSION['user']->getOneRowWithId('token', $_SESSION['user']->getId()));
        }

	    return false;

    }

    public static function userExist(User $user, String $email) {
        $test = $user->countRow("user", "email", "email", $email);

        echo "count " . $test . " :: ";
        if ($test == 0) {
            $_SESSION["userExist"] = false;
            return true;
        }
        $_SESSION["userExist"] = true;
        //var_dump($_SESSION);
        return false;
    }

}