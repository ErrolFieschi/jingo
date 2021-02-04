<?php

namespace App\Core;

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

}