<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Page extends Database
{
    protected $id = null;
    protected $title;
    protected $name;
    protected $code;
    protected $url;
    protected $active;

    protected $bdd;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }


}
