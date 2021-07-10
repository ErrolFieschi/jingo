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

        $formUpdateUser = $user->formUpdateUser();

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
        $view->assign('formUpdateUser', $formUpdateUser);

    }

    public function updateUserAction() {
        $view = new View("adminUser", "back");
        $user = new U();

        $formUpdateUser = $user->formUpdateUser();


        $dataUp = $user->globalFind('SELECT wlms_user.id as user_id,
        wlms_user.firstname,
        wlms_user.lastname,
        wlms_user.email,
        wlms_user.status
        FROM wlms_user ORDER BY wlms_user.createdAt', []);

        $view->assign("dataUp", $dataUp);


        if (!empty($_POST)) {
            $errors = FormValidator::check($formUpdateUser, $_POST);
            if ($user->countRow('user', 'id', 'email', $_POST["email"]) != 1) {
                if (empty($errors)) {
                    $user->setFirstname($_POST["firstname"]);
                    $user->setLastname($_POST['lastname']);
                    $user->setEmail($_POST['email']);
                    $user->setStatus($_POST['status']);
                    $user->save();

                } else {
                    var_dump($errors);
                }
            } else {
                $view->assign("errors", $errors);
            }
        }
        $view->assign("formUpdateUser", $formUpdateUser);

    }
}
