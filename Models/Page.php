<?php


namespace App\Models;


use App\Core\Database;

class Page extends Database
{
    private $name;
    private $title;
    private $controller = "Front";
    private $action = "defaultAction";

    protected $bdd;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class()); //App\Models\User
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));

    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function createPage()
    {

    }

    public function addPages()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "add_page",
                "class" => "add_pages",
                "submit" => "Ajouter une page"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "label" => "Nom de la page",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "page_name",
                    "class" => "form_input",
                    "placeholder" => "Nom de la page",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "url" => [
                    "type" => "text",
                    "label" => "URL de la page",
                    "minLength" => 2,
                    "maxLength" => 100,
                    "id" => "url_page",
                    "class" => "form_input",
                    "placeholder" => "URL de la page",
                    "error" => "L'URL doit faire entre 2 et 100 caractères",
                    "required" => true
                ],
                "title" => [
                    "type" => "text",
                    "label" => "Titre de la page",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "page_title",
                    "class" => "form_input",
                    "placeholder" => "Titre de la page",
                    "error" => "Le titre de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
            ],
        ];
    }
}
