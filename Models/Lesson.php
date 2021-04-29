<?php

namespace App\Models;

use App\Core\Database;

class Lesson extends Database
{

    private $id = null;
    protected $title;
    protected $description;
    protected $tags;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function formLesson()
    {
        return [

            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"form_lesson",
                "class"=>"form_input",
                "submit"=>"Ajouter une lesson"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "title",
                    "class" => "form-control",
                    "placeholder" => "Titre de la leçon",
                    "error" => "Le titre doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "description" => [
                    "type" => "textarea",
                    "label" => "Ma leçon",
                    "id" => "description",
                    "class" => "form-control",
                    "placeholder" => "Tapez votre cours ici",
                    "required" => true
                ],
                "tags"=>[
                    "type"=>"text",
                    "label"=>"tags",
                    "id"=>"tags",
                    "class"=>"form-control",
                    "required"=>false
                ]
            ]
        ];
    }
}




