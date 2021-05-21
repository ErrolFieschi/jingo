<?php

namespace App\Core;

class Database
{
    protected static $_instance = null ;
	private $pdo ;
	private $table;
	protected $bdd ;

	private function __construct(){
		try{
            $this->pdo =  new \PDO(DBDRIVER.":dbname=".DBNAME.";host=".DBHOST.";port=".DBPORT,DBUSER,DBPWD);
			if(ENV == "dev"){
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    		}
		}catch(\Exception $e){
			die("Erreur SQL " . $e->getMessage());
		}
	}

    public static function getInstance() {
	    if(is_null(self::$_instance)) {
            self::$_instance = new Database() ;
        }
	    return self::$_instance ;
    }

    public function setTable($table) {

        self::$_instance->table = $table ;
    }


	public function save(){

		$columns = array_diff_key (
						get_object_vars($this),
						get_class_vars(get_class())
					);


		//INSERT OU UPDATE
		// $id == null -> INSERT SINON UPDATE
		if( is_null($this->getId()) ){
			//INSERT
			$query = $this->bdd->pdo->prepare("INSERT INTO ".$this->bdd->table." (".
					implode(",", array_keys($columns))
				.") 
				VALUES ( :".
					implode(",:", array_keys($columns))
				." );");	
		}else{

			$sql = "";
			foreach ($columns as $col => $value) {
			    if(!empty($value))
			        $sql.= $col ." = '". $value . "' , " ;
            }
            $query = $this->bdd->pdo->prepare("UPDATE ". $this->bdd->table . " SET " . rtrim($sql, " , ")."WHERE id =" .$this->getId() . ";");
		}
		$query->execute($columns);

	}



	public function updateOneRow($col, $value) {

	    $query = $this->bdd->pdo->prepare("UPDATE ".$this->bdd->table." SET ".$col." = :value ;");

	    $query->execute([
            "value" => $value
        ]);

    }

    public function getAllRow() {

        $query = $this->bdd->pdo->prepare("SELECT * FROM ".$this->bdd->table." ;");

        $query->execute();

        return $query->fetchAll();

    }

    public function getRowWithId($id) {

        $query = $this->bdd->pdo->prepare("SELECT * FROM ".$this->bdd->table." WHERE id = :id ;");

        $query->execute([
            "id" => $id
        ]);

        return $query->fetch();

    }

    public function getOneRowWithId($col, $id) {

        $query = $this->bdd->pdo->prepare("SELECT :col FROM ".$this->bdd->table." WHERE id = :id ;");

        $query->execute([
            "col" => $col,
            "id" => $id
        ]);

        return $query->fetch();

    }

    public function searchOneColWithOneRow($table, $search, $whereCondition, $whereValue) {
        $query = $this->bdd->pdo->prepare("SELECT " . $search . " FROM ".DBPREFIXE.$table." WHERE ".$whereCondition. " = :find ;");

        $query->execute([
            "find" => $whereValue
        ]);

        return $query->fetch();
    }

    public function countRow($table, $search, $whereCondition, $whereValue){
        $query = $this->bdd->pdo->prepare("SELECT " . $search . " FROM ".DBPREFIXE.$table." WHERE ".$whereCondition. " = :find LIMIT 1;");

        $query->execute([
            "find" => $whereValue
        ]);

        return $query->rowCount();
    }

}






