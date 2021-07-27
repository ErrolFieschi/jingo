<?php

namespace App\Core;

use App\Models\User;
use PDO;

class Installer {

  private $pdo;
  private $db_host;
  private $db_name;
  private $db_user_root;
  private $db_user_pwd;

  public function __construct(String $host = null, String $db_name = null,String $root = null, String $root_password= null) {
      if($host != null) {
          $this->db_host = $host ;
          $this->db_name = $db_name ;
          $this->db_user_root = $root ;
          $this->db_user_pwd = $root_password ;
          try {
              $this->pdo = new \PDO("mysql:host=".$host.";port=3306", $root, $root_password);
          } catch (\Exception $e) {
              die("Erreur SQL " . $e->getMessage());
          }
      }
  }

  private function createDatabase(String $BDDName) {
      $this->pdo->exec("CREATE DATABASE IF NOT EXISTS ".$BDDName." ;");
  }

  private function addNewUser(String $username, String $password, String $host) {
      $this->pdo->exec("CREATE USER '".$username."'@'".$host."' IDENTIFIED BY '".$password."';");
  }
  
  private function grantPermissionsToUser(String $username) {
      $this->pdo->exec("GRANT ALL PRIVILEGES ON * . * TO '".$username."'@'".$this->db_host."';");
  }

  private function useDb(String $BDDName) {
      $this->pdo->exec("USE ".$BDDName.";");
  }

  public function setupDatabaseAction()
  {
      if(isset($_SESSION['isStepOneOk']) && $_SESSION['isStepOneOk'] == true
          && isset($_SESSION['isStepTwoOk']) && $_SESSION['isStepTwoOk'])
      {
          $view = new View('installer/setup');
          $form = $this->formSettingsSite();
          $view->assign('form', $form);

          if (!empty($_POST)) {
              $errors = FormValidator::check($form, $_POST);
              if (empty($errors)) {

                  file_put_contents('.env','TITLE='.$_POST['TITLE'],FILE_APPEND);
                  $user = new User();
                  $user->setFirstname(htmlspecialchars($_POST["firstname"]));
                  $user->setLastname(htmlspecialchars($_POST["lastname"]));
                  $user->setEmail(htmlspecialchars($_POST["email"]));
                  $user->setPwd($_POST["pwd"]);
                  $user->setBirthday($_POST["birthday"]);
                  $user->setCountry($_POST["country"]??$user->getCountry()??'FR');
                  $user->setRole(1);
                  $user->save();

                  header('Location: /login');
              } else $view->assign('errors', $errors);
          }
      } else Router::redicrection404();
  }

  public function setupMailingAction(){
      if(isset($_SESSION['isStepOneOk']) && $_SESSION['isStepOneOk'] == true) {
          $view = new View('installer/setupMailing');
          $form = $this->formSettingMailing();
          $view->assign('form', $form);

          if (!empty($_POST)) {
              $errors = FormValidator::check($form, $_POST);
              if (empty($errors)) {

                  $this->writeEnv($_POST);

                  $_SESSION['isStepTwoOk'] = true;
                  header('Location: /install/3');
              } else $view->assign('errors', $errors);
          }
      } else Router::redicrection404() ;

  }

  public function setupAction(){
        $view = new View("installer/setupDB");
        $form = $this->formSettingsDatabase();
        $view->assign("form", $form);

        if (!empty($_POST)) {
            $errors = FormValidator::check($form, $_POST);
            if (empty($errors)) {

                $newInstaller = new Installer($_POST["DBHOST"], $_POST['DBNAME'], $_POST['DBUSER'], $_POST['DBPWD']);

                $newInstaller->createDatabase($newInstaller->db_name);
                $newInstaller->addNewUser($newInstaller->db_user_root, $newInstaller->db_user_pwd, $newInstaller->db_host);
                $newInstaller->grantPermissionsToUser($newInstaller->db_host);

                $newInstaller->useDb($newInstaller->db_name);


                if( $sql = file_get_contents('Core/data.sql')) {

                    $sql = str_replace('PREFIXE',$_POST['DBPREFIXE'],$sql);

                    $query = $newInstaller->pdo->prepare($sql);
                    $query->execute() ;


                }

                $this->writeEnv($_POST);

                $_SESSION['isStepOneOk'] = true;
                header('Location: /install/2');
            } else {
                $view->assign("errors", $errors);
            }
        }
  }


  private function writeEnv(Array $post) {
          foreach ($post as $key => $value) {
              file_put_contents('.env',$key.'='.$value.PHP_EOL,FILE_APPEND) ;
          }
  }

  private function formSettingMailing() {
      return [
          'config' => [
            'method'=>'POST',
            'action'=>'',
            'id'=>'setup_mailing',
            'class'=>'form_builder mb-5',
            'submit'=>'Passer à l\'étape suivante'
          ],
          'inputs'=>[
              'MAIL'=>[
                  'type'=>'email',
                  'label'=>'Adresse email pour l\'envoie automatique',
                  'class'=>'form_input',
                  'id'=>'email_config',
                  'error'=>'Email non valide',
                  'required'=>true
              ],
              'MAILPWD'=>[
                  'type'=>'password',
                  'label'=>'Mot de passe de l\'adresse email',
                  'id'=>'pwd_mailing',
                  'class'=>'form_input',
                  'required'=>true
              ]
          ]
      ];
  }
  private  function formSettingsDatabase() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "setup_database",
                "class" => "form_builder mb-5",
                "submit" => "Passer à l'étape suivante"
            ],
            "inputs"=>[
                "DBNAME"=>[
                    "type"=>"text",
                    "label"=>"Nom de la base",
                    "minLength"=>3,
                    "maxLength"=>15,
                    "id"=>"name_db",
                    "class"=>"form_input",
                    "error"=>"Votre nom de base de données doit faire entre 3 et 15 caractères",
                    "required"=>true
                ],
                "DBUSER"=>[
                    "type"=>"text",
                    "label"=>"Nom d'utilisateur",
                    "minLength"=>4,
                    "maxLength"=>20,
                    "id"=>"username_db",
                    "class"=>"form_input",
                    "error"=>"Votre nom d'utilisateur doit faire entre 4 et 20 caractères",
                    "required"=>true
                ],
                "DBPWD"=>[
                    "type"=>"password",
                    "label"=>"Mot de passe",
                    "minLength"=>5,
                    "id"=>"pwd",
                    "class"=>"form_input",
                    "error"=>"Votre mot de passe doit faire au minimum 5 caractères",
                    "required"=>true
                ],
                "DBPREFIXE"=>[
                    "type"=>"text",
                    "label"=>"Prefix",
                    "minLength"=>2,
                    "maxLength"=>10,
                    "id"=>"prefix_db",
                    "class"=>"form_input",
                    "error"=>"Votre prefixe doit faire entre 2 et 10 caractères",
                    "required"=>true
                ],
                "DBHOST"=>[
                    "type"=>"text",
                    "label"=>"Host",
                    "minLength"=>4,
                    "maxLength"=>15,
                    "id"=>"host_db",
                    "class"=>"form_input",
                    "error"=>"Votre host doit faire entre 4 et 15 caractères",
                    "required"=>true
                ],
                "DBPORT"=>[
                    "type"=>"number",
                    "label"=>"port",
                    "id"=>"host_db",
                    "class"=>"form_input",
                    "error"=>"",
                    "required"=>true
                ],
            ]

        ];
  }

  private  function formSettingsSite() {
      return [
          "config" => [
            "method" => "POST",
            "action" => "",
            "id" => "setup_database",
            "class" => "form_builder mb-5",
            "submit" => "Finir"
         ],
         "inputs" => [
            "TITLE"=>[
              'type'=>'text',
              'label'=>'Titre du site',
              'minLength'=>2,
              'id'=>'titre',
              'class'=>'form_input',
              'placeholder'=>'Titre du site',
              'error'=>'Votre titre doit faire minimum 2 caractères',
              'required'=>true
            ],
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
             ]
         ]
      ];
  }
}