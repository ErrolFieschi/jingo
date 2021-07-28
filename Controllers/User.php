<?php


namespace App\Controller;

use App\Core\Database;
use App\Core\FormValidator;
use App\Core\Security as Secu;
use App\Core\View;
use App\Models\User as U;

class User
{

    // Affichage Utilisateurs et modification utilisateur
    public function userAction() {

        $view = new View("adminUser", "back");
        $user = new U();

        $formUpdateUser = $user->formUpdateUser();
        $table = DBPREFIXE."user" ;
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
        FROM $table ", []);

        $view->assign("data", $data);
        $view->assign("rolesUser", $user->rolesUser());

        if (isset($_GET['id'])) {
            $userSelected = $user->customSelectFromATable("user", "*", "id", $_GET['id']);
            $view->assign("userSelected", $userSelected);
            $formUser = $user->updateUser();
            foreach ($formUser['inputs'] as $key => $col) {
                $formUser['inputs'][$key]['value'] = $userSelected[0][$key];
            }
            $view->assign("formUser", $formUser);

            if(!empty($_POST)) {
                !Secu::userExist($user, $_POST["email"], $user->customSelectFromATable('user', 'email', 'id', $_GET['id'])[0]['email']);
                $errors = FormValidator::check($formUser, $_POST);
                if(empty($errors)) {

                    $user->setId($_GET['id']);
                    $user->setFirstname($_POST["firstname"]);
                    $user->setLastname($_POST["lastname"]);
                    $user->setBirthday($_POST["birthday"]);
                    $user->setRole($_POST["role"]);
                    $user->setEmail($_POST["email"]);
                    
                    if ($_SESSION['id'] == $_GET['id']) {
                        $user->setToken($_SESSION['token']);
                    }
                    
                    $user->save();

                    header("Location: /admin-user");
                } else {
                    $view->assign("errors", $errors);
                }
            }

        } else {
            $view->assign("formUser", $user->updateUser());
        }

    }

    // Suppression Utilisateur
    public function deleteUserAction()
    {
        if (!empty($_GET['id'] && isset($_GET['id']))) {
            Database::deleteFromId('user', 'id', $_GET['id']);
        }
        header('Location: /admin-user');
    }
}
