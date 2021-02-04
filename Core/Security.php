<?php

namespace App\Core;

class Security
{

	public function isConnected(){
		return true;
	}

	public static function generateToken($user){

	   $token = \OAuth::generateToken(4096);
	   $user->setToken($token);

    }

    public static function checkToken($user){

    }

}
