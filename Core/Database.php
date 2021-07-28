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

    /**
     * Return a instance of PDO
     * if PDO instance is null it create a new and return it
     * @return Database|null
     */
    public static function getInstance() {
	    if(is_null(self::$_instance)) {
            self::$_instance = new Database() ;
        }
	    return self::$_instance ;
    }

    /**
     * @param $table
     */
    public function setTable($table) {

        self::$_instance->table = $table ;
    }

    /**
     * Save a model if not existing and update if id set
     */
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
			    if(isset($value))
			        $sql.= $col ." = '". $value . "' , " ;
            }

            $query = $this->bdd->pdo->prepare("UPDATE ". $this->bdd->table . " SET " . rtrim($sql, " , ")."WHERE id =" .$this->getId() . ";");
            $query->execute();
		}

	}

    /**
     * Deleting a table
     * @param String $BDDTableName
     * @param String $where
     * @param $value
     */
    public static function deleteFromId(String $BDDTableName, String $where, $value)
    {
        $query = self::getInstance()->pdo->prepare("DELETE FROM " . DBPREFIXE . $BDDTableName . " WHERE " . $where . " = :value ;");
        $query->execute([
            "value" => $value
        ]);
    }

    /**
     * update one row of a table
     * @param String $BDDTableName
     * @param String $col
     * @param $value
     * @param $where
     * @param $valueWhere
     */
    public static function updateOneRow(String $BDDTableName, String $col, $value, $where, $valueWhere)
    {

        $query = self::getInstance()->pdo->prepare("UPDATE " . DBPREFIXE . $BDDTableName . " SET " . $col . " = :value WHERE " . $where . " = :valueWhere;");

        $query->execute([
            "value" => $value,
            "valueWhere" => $valueWhere
        ]);

    }


    /**
     * Allow us to create an SQL and execute it
     * @param string $sql
     * @param array $params
     * @return array|null
     */
    public function globalFind(string $sql, array $params = []): ?array
    {
        $statement = $this->internalExec($sql, $params);
        if ($statement === null) {
            return [];
        }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param string $sql
     * @param array $params
     * @return null
     */
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

    /**
     * This method allow us to search with ONE where condition
     * @param $table
     * @param $select
     * @param $whereCondition
     * @param $whereValue
     * @return mixed
     */
    public function searchOneColWithOneRow($table, $select, $whereCondition, $whereValue) {
        $query = self::getInstance()->pdo->prepare("SELECT " . $select . " FROM ".DBPREFIXE.$table." WHERE ".$whereCondition. " = :find ;");

        $query->execute([
            "find" => $whereValue
        ]);

        return $query->fetch();
    }
    
    public function countRowWithoutCondition($table){
        $query = $this->bdd->pdo->prepare("SELECT COUNT(*) FROM ".DBPREFIXE.$table." ;");

        $query->execute();

        return $query->fetch();
    }

    public function innerJoinGroupBy($table, $joinTable, $joinId, $joinName){
        $query = $this->bdd->pdo->prepare("SELECT ".DBPREFIXE.$joinTable.".".$joinName.", COUNT(".$joinId.") FROM ".DBPREFIXE.$table." INNER JOIN ".DBPREFIXE.$joinTable." ON ".$joinId." = ".DBPREFIXE.$joinTable.".id GROUP BY ".DBPREFIXE.$joinTable.".".$joinName." ;");

        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param $table
     * @param $search
     * @param $whereCondition
     * @param $whereValue
     * @return mixed
     */
    public function countRow($table, $search, $whereCondition, $whereValue){
        $query = $this->bdd->pdo->prepare("SELECT " . $search . " FROM ".DBPREFIXE.$table." WHERE ".$whereCondition. " = :find LIMIT 1;");

        $query->execute([
            "find" => $whereValue
        ]);

        return $query->rowCount();
    }

    /**
     * This method allow us to custom a select into a table
     * with ONE Where condition (not mandatory)
     * and limit (not mandatory)
     * @param String $BDDTableName
     * @param String $customSelect
     * @param String|null $tableRowInWhereCondition
     * @param String|null $tableRowValue
     * @param bool $limit
     * @param String $orderBy
     * @return array|mixed
     */
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






