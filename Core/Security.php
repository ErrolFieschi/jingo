<?php

namespace App\Core;

use App\Models\User;

class Security
{
    /**
     * Testing if user is connected thanks to his token
     * @return bool
     */
	public static function isConnected(){
        if(isset($_SESSION['connected']) && $_SESSION['connected'] == true)
		    return self::checkToken();
        return false ;
	}

    /**
     * Verify if user Tokoen is the same store in Database
     * @return bool
     */
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

    /**
     * Verify if user password is the same between typed one and stored in Database
     * @param User $user User to test his password
     * @param String $pwd Password type in input
     * @return bool
     */
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

    /**
     * Verify if user token is the same between stored in cookie & database
     * @param User $user User to test his token
     * @param String $token a token
     * @return bool
     */
    public static function userTestConnectionByToken(User $user ,String $token) : bool {
	    return $user->getToken() == $token ;
    }

    /**
     * Verify is user exist thanks to his email
     * @param User $user
     * @param String $email
     * @param String|null $emailVerif
     * @return bool
     */
    public static function userExist(User $user, String $email, String $emailVerif = null): bool {
        $test = $user->countRow("user", "email", "email", $email);
        if ($test == 0 || !empty($emailVerif) && $email == $emailVerif) {
            $_SESSION["userExist"] = false;
            return false;
        }
        $_SESSION["userExist"] = true;
        return true;
    }

    /**
     * Return user role if exist and false if none assign
     * @return String
     */
    public static function userRole(): String {
        if (self::isConnected()) {
            $role_user = Database::customSelectFromATable('user', 'role', 'id', $_SESSION['id']);
            return $role_user[0]['role'];
        }
        return  false ;
    }

    /**
     * Deleting installer after use
     */
    public static function deleteInstaller() {
        try {
            unlink("Core/_data.sql") ;
            unlink('Core/Installer.php');
        } catch (\Exception $e){}
    }

}
