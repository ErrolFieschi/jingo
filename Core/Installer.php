<?php

namespace App\Core;

use PDO;

class Installer {

  private $pdo;

  public function __construct(String $host, String $root, String $root_password) {
      try {
          $this->pdo = new \PDO("mysql:host=".$host.";port=3306", $root, $root_password);
      } catch (\Exception $e) {
          die("Erreur SQL " . $e->getMessage());
      }
  }

  public function createDatabase(String $BDDName) {
      $this->pdo->exec("CREATE DATABASE IF NOT EXISTS ".$BDDName." ;");
  }

  public function addNewUser(String $username, String $password, String $host) {
      $this->pdo->exec("CREATE USER '".$username."'@'".$host."' IDENTIFIED BY '".$password."';");
  }
  
  public function grantPermissionsToUser(String $username) {
      $this->pdo->exec("GRANT ALL PRIVILEGES ON * . * TO '".$username."'@'localhost';");
  }

  public function useDb(String $BDDName) {
      $this->pdo->exec("USE ".$BDDName.";");
  }

  public function populateDatabase(String $new_table, String $prefix_db, array $attributes) {

      $sql = "";
      $last_key = end(array_keys($attributes));
      foreach ($attributes as $key => $value) {
          if (!empty($value) ) {
              $sql .= $key." ".$value['type'];
              if (isset($value['not_null'])) $sql .= $value['not_null'] ? " NOT NULL" : " NULL";
              if (isset($value['default'])) $sql .= " DEFAULT '".$value['default']."'";
              if (isset($value['default_without'])) $sql .= " DEFAULT ".$value['default_without'];
              if (isset($value['extra'])) $sql .= " ".$value['extra'];
              if ($key !== $last_key) $sql .= ", ";
          }
      }

      $this->pdo->exec("CREATE TABLE ".$prefix_db.$new_table." (".$sql.") ;");
  }


  public static function formSettingsDatabase() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "setup_database",
                "class" => "form_builder mb-5",
                "submit" => "Passer a l'étape suivante"
            ],
            "inputs"=>[
                "name_db"=>[ 
                    "type"=>"text",
                    "label"=>"Nom de la base",
                    "minLength"=>3,
                    "maxLength"=>15,
                    "id"=>"name_db",
                    "class"=>"form_input",
                    "error"=>"Votre nom de base de données doit faire entre 3 et 15 caractères",
                    "required"=>true
                ],
                "username_db"=>[ 
                    "type"=>"text",
                    "label"=>"Nom d'utilisateur",
                    "minLength"=>4,
                    "maxLength"=>20,
                    "id"=>"username_db",
                    "class"=>"form_input",
                    "error"=>"Votre nom d'utilisateur doit faire entre 4 et 20 caractères",
                    "required"=>true
                ],
                "pwd"=>[ 
                    "type"=>"password",
                    "label"=>"Mot de passe",
                    "minLength"=>5,
                    "id"=>"pwd",
                    "class"=>"form_input",
                    "error"=>"Votre mot de passe doit faire au minimum 5 caractères",
                    "required"=>true
                ],
                "prefix_db"=>[ 
                    "type"=>"text",
                    "label"=>"Prefix",
                    "minLength"=>2,
                    "maxLength"=>4,
                    "id"=>"prefix_db",
                    "class"=>"form_input",
                    "error"=>"Votre prefixe doit faire entre 2 et 4 caractères",
                    "required"=>true
                ],
                "host_db"=>[ 
                    "type"=>"text",
                    "label"=>"Host",
                    "minLength"=>4,
                    "maxLength"=>15,
                    "id"=>"host_db",
                    "class"=>"form_input",
                    "error"=>"Votre host doit faire entre 4 et 15 caractères",
                    "required"=>true
                ],
            ]

        ];
    }


    public static function formSettingsSite() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "setup_database",
                "class" => "form_builder mb-5",
                "submit" => "Terminer"
            ],
            "inputs" => [
                "title"=>[ 
                    "type"=>"text",
                    "label"=>"Titre du site",
                    "minLength"=>5,
                    "maxLength"=>320,
                    "id"=>"title",
                    "class"=>"form_input",
                    "error"=>"Votre titre doit faire entre 5 et 320 caractères",
                    "required"=>true
                ],
                "username_site"=>[ 
                    "type"=>"text",
                    "label"=>"Nom de l'utilisateur sur le site",
                    "minLength"=>5,
                    "maxLength"=>20,
                    "id"=>"username_site",
                    "class"=>"form_input",
                    "error"=>"Votre titre doit faire entre 5 et 320 caractères",
                    "required"=>true
                ],
                "email"=>[
                    "type"=>"email",
                    "label"=>"Email",
                    "minLength"=>8,
                    "maxLength"=>320,
                    "id"=>"email",
                    "class"=>"form_input",
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "required"=>true
                ],
            ],
        ];
    }

    public static function allTablesWithAttributes() {

        return [
            "user" => [
                "id" => [         
                    "type"=>"INT",
                    "not_null"=>true,
                    "extra"=>"AUTO_INCREMENT"
                ],
                "firstname" => [         
                    "type"=>"VARCHAR(55)",
                    "not_null"=>true
                ],
                "lastname" => [         
                    "type"=>"VARCHAR(255)",
                    "not_null"=>true
                ],
                "email" => [         
                    "type"=>"VARCHAR(320)",
                    "not_null"=>true
                ],
                "pwd" => [         
                    "type"=>"VARCHAR(255)",
                    "not_null"=>true
                ],
                "country" => [         
                    "type"=>"CHAR(2)",
                    "not_null"=>true,
                    "default"=>"fr",
                ],
                "role" => [         
                    "type"=>"TINYINT(4)",
                    "not_null"=>true,
                    "default"=>0,
                ],
                "isDeleted" => [         
                    "type"=>"TINYINT(1)",
                    "not_null"=>true,
                    "default"=>0,
                ],
                "status" => [         
                    "type"=>"TINYINT(4)",
                    "not_null"=>true,
                    "default"=>0,
                ],
                "token" => [         
                    "type"=>"VARCHAR(64)",
                    "not_null"=>true
                ],
                "birthday" => [         
                    "type"=>"DATE",
                    "not_null"=>false
                ],
                "createdAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>true,
                    "default_without"=>"CURRENT_TIMESTAMP"
                ],
                "updatedAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>false,
                    "default_without"=>"NULL",
                    "extra"=>"ON UPDATE CURRENT_TIMESTAMP"
                ],
                "PRIMARY KEY" => [
                    "type"=>"(id)"
                ]
            ],
            "training" => [
                "id" => [         
                    "type"=>"INT",
                    "not_null"=>true,
                    "extra"=>"AUTO_INCREMENT"
                ],
                "title" => [         
                    "type"=>"VARCHAR(200)",
                    "not_null"=>false
                ],
                "role" => [         
                    "type"=>"INT",
                    "not_null"=>true
                ],
                "active" => [         
                    "type"=>"INT",
                    "not_null"=>true
                ],
                "duration" => [         
                    "type"=>"INT",
                    "not_null"=>false
                ],
                "createby" => [         
                    "type"=>"VARCHAR(200)",
                    "not_null"=>true
                ],
                "template" => [         
                    "type"=>"TEXT",
                    "not_null"=>false
                ],
                "description" => [         
                    "type"=>"TEXT",
                    "not_null"=>false
                ],
                "image" => [         
                    "type"=>"VARCHAR(200)",
                    "not_null"=>false
                ],
                "training_tag_id" => [         
                    "type"=>"INT",
                    "not_null"=>false
                ],
                "url" => [         
                    "type"=>"VARCHAR(200)",
                    "not_null"=>true
                ],
                "createdAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>true,
                    "default_without"=>"CURRENT_TIMESTAMP"
                ],
                "updatedAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>false,
                    "default_without"=>"NULL",
                    "extra"=>"ON UPDATE CURRENT_TIMESTAMP"
                ],
                "PRIMARY KEY" => [
                    "type"=>"(id)"
                ]
            ],
            "part" => [
                "id" => [         
                    "type"=>"INT",
                    "not_null"=>true,
                    "extra"=>"AUTO_INCREMENT"
                ],
                "training_id" => [         
                    "type"=>"INT",
                    "not_null"=>true
                ],
                "title" => [    
                    "type"=>"VARCHAR(250)",
                    "not_null"=>false
                ],
                "createby" => [  
                    "type"=>"VARCHAR(255)",
                    "not_null"=>false
                ],
                "order_" => [         
                    "type"=>"INT",
                    "not_null"=>false
                ],
                "icon" => [         
                    "type"=>"VARCHAR(255)",
                    "not_null"=>false
                ],
                "url" => [         
                    "type"=>"VARCHAR(200)",
                    "not_null"=>true
                ],
                "createdAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>true,
                    "default_without"=>"CURRENT_TIMESTAMP"
                ],
                "updatedAt" => [         
                    "type"=>"TIMESTAMP",
                    "not_null"=>false,
                    "default_without"=>"NULL",
                    "extra"=>"ON UPDATE CURRENT_TIMESTAMP"
                ],
                "PRIMARY KEY" => [
                    "type"=>"(id)"
                ]
            ]
        ];

    }

}