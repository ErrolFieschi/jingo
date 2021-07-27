<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Library extends Database
{
    private $id = null;
    protected $image;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * @param mixed $Image
     */
    public function setImage($Image): void
    {
        $this->Image = $Image;
    }

    public function formImage()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_image",
                "class" => "form_input",
                "submit" => "Ajouter une image"
            ],
            "inputs" => ["photo" => [
                "type" => "file",
                "label" => "Image de la leçon",
                "id" => "photoImport",
                "class" => "form-control"
            ]
            ]
        ];
    }
}