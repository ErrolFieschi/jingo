<?php

namespace App\Core;

use PDO;

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

            $query->execute($columns);

		}else{
			$sql = "";
			foreach ($columns as $col => $value) {
			    if(!empty($value))
			        $sql.= $col ." = '". $value . "' , " ;
            }

            $query = $this->bdd->pdo->prepare("UPDATE ". $this->bdd->table . " SET " . rtrim($sql, " , ")."WHERE id =" .$this->getId() . ";");
            $query->execute();
		}

	}

    public static function deleteFromId(String $BDDTableName, String $where, $value)
    {
        $query = self::getInstance()->pdo->prepare("DELETE FROM " . DBPREFIXE . $BDDTableName . " WHERE " . $where . " = :value ;");
        $query->execute([
            "value" => $value
        ]);
    }

    public static function updateOneRow(String $BDDTableName, String $col, $value, $where, $valueWhere)
    {

        $query = self::getInstance()->pdo->prepare("UPDATE " . DBPREFIXE . $BDDTableName . " SET " . $col . " = :value WHERE " . $where . " = :valueWhere;");

        $query->execute([
            "value" => $value,
            "valueWhere" => $valueWhere
        ]);

    }

    public function getAllRow() {

        $query = $this->bdd->pdo->prepare("SELECT * FROM ".$this->bdd->table." ;");

        $query->execute();

        return $query->fetchAll();

    }

    public function getRowWithId($id) {

        $query = $this->bdd->pdo->prepare("SELECT * FROM ".$this->bdd->table." WHERE part_id = :id ;");

        $query->execute([
            "id" => $id
        ]);

        return $query->fetchAll();

    }

    public function globalFind(string $sql, array $params = []): ?array
    {
        $statement = $this->internalExec($sql, $params);
        if ($statement === null) {
            return [];
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    private function internalExec(string $sql, array $params)
    {
        $statement = $this->bdd->pdo->prepare($sql);
        if ($statement === false) {
            return null;
        }
        if(count($params) > 0){
        $res = $statement->execute($params);
        }else{
            $res = $statement->execute();
        }
        if ($res === false) {
            return null;
        }
        return $statement;
    }


    public function getOneRowWithId($col, $id)
    {

        $query = $this->bdd->pdo->prepare("SELECT :col FROM ".$this->bdd->table." WHERE id = :id ;");

        $query->execute([
            "col" => $col,
            "id" => $id
        ]);

        return $query->fetch();

    }

    public function searchOneColWithOneRow($table, $select, $whereCondition, $whereValue) {
        $query = self::getInstance()->pdo->prepare("SELECT " . $select . " FROM ".DBPREFIXE.$table." WHERE ".$whereCondition. " = :find ;");

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

    public static function customSelectFromATable(String $BDDTableName, String $customSelect , String $tableRowInWhereCondition =null, String $tableRowValue=null, Bool $limit = false, String $orderBy = 'id') {

	    $sql = "SELECT " . $customSelect .
            " FROM ".DBPREFIXE.$BDDTableName ;
	    if($tableRowValue != null && $tableRowInWhereCondition != null)
            $sql .= " WHERE ".$tableRowInWhereCondition. " = :find " ;
        $sql .= " ORDER BY " . $orderBy;
	    if ($limit)
          $sql .= " LIMIT 1;" ;

	    $query = self::getInstance()->pdo->prepare($sql);

	    if($tableRowValue != null)
            $query->execute([
                "find" => $tableRowValue
            ]);
	    else  $query->execute();

	    if($limit)
            return $query->fetch() ;
        return $query->fetchAll() ;

    }

}






