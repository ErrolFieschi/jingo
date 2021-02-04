<?php

namespace App\Core;

class Security
{

	public function isConnected($user){

	    $this->checkToken($user);

		return true;
	}

    private function checkToken($user) {

	    return ($user->getToken() == $user->getOneRowWithId('token', $user->getId()));

    }

}