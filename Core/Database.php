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

		if( is_null($this->getId()) ){

			$query = $this->bdd->pdo->prepare("INSERT INTO ".$this->bdd->table." (".
					implode(",", array_keys($columns))
				.") 
				
				VALUES ( :".

					implode(",:", array_keys($columns))

				." );");	
		}else{
            $query = "" ;
		}
        var_dump($this);
		$query->execute($columns);
        if(is_null($this->getId()))

            $this->setId($this->bdd->pdo->lastInsertId()) ;

        echo $this->getId() ;
		


	}

}






