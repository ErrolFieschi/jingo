<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\View;
use App\Models\User as U;

class User
{
    public function userAction()
    {

        //gérer les status
        // 0 => normal user
        // 1 => Premium
        // 2 => VIP
        // 3 => Admin

        $view = new View("adminUser", "back");
        $user = new U();

        $data = $user->globalFind("SELECT 
        id,
        firstname,
        lastname,
        email,
        DATE_FORMAT(birthday, '%d/%m/%Y') as birthday,
        pwd,
        role,
        status,
        country,
        isDeleted,
        DATE_FORMAT(createdAt, '%d/%m/%Y') as createdAt,
        DATE_FORMAT(updatedAt, '%d/%m/%Y') as updatedAt
        FROM wlms_user", []);

        $view->assign("data", $data);

    }
}
