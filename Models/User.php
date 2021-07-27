<?php

namespace App\Models;

use App\Core\Database;

class User extends Database
{

    private $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $birthday;
    protected $country = "fr";
    protected $role = 0;
    protected $status = 0;
    protected $isDeleted = 0;
    protected $token;

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
    }

    protected $bdd;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class()); //App\Models\User
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
        $this->setToken();

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
        // double action de peupler l'objet avec ce qu'il y a en bdd
        // https://www.php.net/manual/fr/pdostatement.fetch.php
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = mb_strtolower($email);
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getIsDeleted(): int
    {
        return $this->isDeleted;
    }


    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->role = $role;
    }


    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function setToken(String $token = null)
    {
        if($token != null)
            $this->token = $token ;
        else $this->token = bin2hex(random_bytes(64));
    }

    public static function rolesUser() {
        return [
            0 => "normal",
            1 => "admin"
        ];
    }

    public static function countriesUser() {
        return [
            'fr' => "France",
            'us' => "Etats-Unis"
        ];
    }

    public function formForgetPassword()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_forget_password",
                "class" => "form_builder",
                "submit" => "Retrouver"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "votre email",
                    "error" => "email non valide ou n'existe pas!",
                    "required" => true
                ]
            ]
        ];
    }


    public function formPWDChange() {
        return[
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_change_pwd",
                "class"=>"form_builder",
                "submit"=>"Changer"
            ],
            "inputs"=>[
                "oldPwd" => [
                    "type" => "password",
                    "label" => "Ancien mot de passe",
                    "id" => "oldPwd",
                    "class" => "form_input_back",
                    "placeholder" => "Votre ancien mot de passe",
                    "required" => false
                ],
                "pwd" => [
                    "type" => "password",
                    "label" => "Nouveau mot de passe",
                    "minLength" => 8,
                    "maj"=> true,
                    "num_verif" => true,
                    "id" => "pwd",
                    "class" => "form_input_back",
                    "placeholder" => "Votre nouveau Mot de passe",
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères",
                    "required" => true
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "label" => "Confirmation",
                    "confirm" => "pwd",
                    "id" => "pwdConfirm",
                    "class" => "form_input_back",
                    "placeholder" => "Confirmer mot de passe",
                    "error" => "Votre mot de mot de passe de confirmation ne correspond pas",
                    "required" => true
                ],
            ]
        ] ;
    }

    public function formRegister()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_register",
                "class" => "form_builder",
                "submit" => "S'inscrire"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "label" => "Votre prénom",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "firstname",
                    "class" => "form_input",
                    "placeholder" => "Prénom",
                    "error" => "Votre prénom doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "lastname" => [
                    "type" => "text",
                    "label" => "Votre nom",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "lastname",
                    "class" => "form_input",
                    "placeholder" => "Nom",
                    "error" => "Votre nom doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "birthday" => [
                    "type" => "date",
                    "label" => "Votre date de naissance",
                    "maxDate" => date("Y-m-d", strtotime("-18 year", time())),
                    "id" => "birthday",
                    "class" => "form_input",
                    "error" => "Votre date de naissance est obligatoire",
                    "required" => true
                ],
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Email",
                    "error" => "Votre email doit faire entre 8 et 320 caractères",
                    "required" => true,
                    "unique" => true,
                    "unique_error" => "Cet email est déjà utilisé."
                ],
                "pwd" => [
                    "type" => "password",
                    "label" => "Votre mot de passe",
                    "minLength" => 8,
                    "maj" => true,
                    "num_verif" => true,
                    "id" => "pwd",
                    "class" => "form_input",
                    "placeholder" => "Mot de passe",
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères",
                    "required" => true
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "label" => "Confirmation",
                    "confirm" => "pwd",
                    "id" => "pwdConfirm",
                    "class" => "form_input",
                    "placeholder" => "Confirmer mot de passe",
                    "error" => "Votre mot de mot de passe de confirmation ne correspond pas",
                    "required" => true
                ],
                "checkCondition" => [
                    "type" => "checkbox",
                    "label" => "",
                    "options" => [
                        "J’ai lu et j’accepte les condition générales d’utilisations et la Politique de Protection des Données Personnelles" => true,
                    ],
                    "id" => "checkCondition",
                    "class" => "form_check",
                    "error" => "Vous devez accepter les condition générales d’utilisations et la Politique de Protection des Données Personnelles",
                    "required" => true
                ],
                "checkNewsletter" => [
                    "type" => "checkbox",
                    "label" => "",
                    "options" => [
                        "Me tenir informé !" => true,
                    ],
                    "id" => "checkNewsletter",
                    "class" => "form_check"
                ]
            ]
        ];
    }


    public function formLogin()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_login",
                "class" => "form_builder",
                "submit" => "Se connecter"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Adresse mail",
                    "error" => "Votre email doit faire entre 8 et 320 caractères",
                    "required" => true
                ],
                "pwd" => [
                    "type" => "password",
                    "label" => "Votre mot de passe",
                    "minLength" => 8,
                    "id" => "pwd",
                    "class" => "form_input",
                    "placeholder" => "Mot de passe",
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères",
                    "required" => true
                ],
                "checkLogin" => [
                    "type" => "checkbox",
                    "label" => "",
                    "options" => [
                        "Se souvenir de moi" => true,
                    ],
                    "id" => "checkLogin",
                    "class" => "form_check"
                ],
            ]

        ];
    }

    public function updateUser()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_register",
                "class" => "form_builder",
                "submit" => "Valider"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "label" => "Votre prénom",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "firstname",
                    "class" => "form_input",
                    "placeholder" => "Prénom",
                    "error" => "Votre prénom doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "lastname" => [
                    "type" => "text",
                    "label" => "Votre nom",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "lastname",
                    "class" => "form_input",
                    "placeholder" => "Nom",
                    "error" => "Votre nom doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "birthday" => [
                    "type" => "date",
                    "label" => "Votre date de naissance",
                    "id" => "birthday",
                    "class" => "form_input",
                    "error" => "Votre date de naissance est obligatoire",
                    "required" => true
                ],
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Email",
                    "error" => "Votre email doit faire entre 8 et 320 caractères",
                    "required" => true,
                    "unique" => true,
                    "unique_error" => "Cet email est déjà utilisé."
                ],
                "role" => [
                    "type" => "select",
                    "label" => "role",
                    "id" => "Role",
                    "class" => "form_input",
                    "options" => $this->rolesUser(),
                    "error" => "Le role est obligatoire",
                    "required" => true
                ],
                "country" => [
                    "type" => "select",
                    "label" => "Pays",
                    "id" => "country",
                    "class" => "form_input",
                    "options" => $this->countriesUser(),
                    "error" => "Le pays est obligatoire",
                    "required" => true
                ],
            ]
        ];
    }

    public function formtest()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_updateUser",
                "class" => "form_builder",
                "submit" => "Sauvegarder"
            ],
            "inputs" => [
                "id"=> [
                    "type"=>"hidden",
                    "id" => "id",
                    "label"=>"",
                    "value"=>"" //USER ID
                ],
                "firstname" => [
                    "type" => "text",
                    "label" => "Prénom de l'utilisateur",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "firstname",
                    "class" => "form_input",
                    "placeholder" => "Prénom",
                    "error" => "Le prénom doit faire entre 2 et 55 caractères",
                    "required" => true
                ]
            ]
        ];
    }
    public function formUpdateUser()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_updateUser",
                "class" => "form_builder",
                "submit" => "Sauvegarder"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "label" => "Prénom de l'utilisateur",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "firstname",
                    "class" => "form_input",
                    "placeholder" => "Prénom",
                    "error" => "Le prénom doit faire entre 2 et 55 caractères",
                    "value"=>"",
                    "required" => true
                ],
                "lastname" => [
                    "type" => "text",
                    "label" => "Nom de l'utilisateur",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "lastname",
                    "class" => "form_input",
                    "placeholder" => "Nom",
                    "error" => "Le nom doit faire entre 2 et 55 caractères",
                    "value"=>"",
                    "required" => true
                ],
                "email" => [
                    "type" => "email",
                    "label" => "Email de l'utilisateur",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Email",
                    "error" => "L'email doit faire entre 8 et 320 caractères",
                    "value"=>"",
                    "required" => true,
                    "unique" => true,
                    "unique_error" => "Cet email est déjà utilisé."
                ],
                "role" => [
                    "type" => "text",
                    "label" => "role",
                    "minLength" => 0,
                    "maxLength" => 2,
                    "id" => "role",
                    "class" => "form_input",
                    "value" => "",
                    "error" => "erreur ",
                    "required" => true
                ],
                "status" => [
                    "type" => "text",
                    "label" => "Status de l'utilisateur",
                    "minLength" => 0,
                    "maxLength" => 2,
                    "id" => "status",
                    "class" => "form_input",
                    "value" => "",
                    "error" => "erreur ",
                    "required" => true
                ]
            ]
        ];
    }

}




