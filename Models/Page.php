<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Page extends Database
{

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }


}
