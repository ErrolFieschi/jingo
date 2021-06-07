<?php

namespace App\Models;

use App\Core\Database;

class Lesson extends Database
{

    private $id = null;
    protected $createby;
    protected $title;
    protected $icon;
    //protected $image;
    protected $code;
    protected $part_id;

    protected $bdd;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }

    /**
     * @return null
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
    public function getCreateby()
    {
        return $this->createby;
    }

    /**
     * @param mixed $createby
     */
    public function setCreateby($createby)
    {
        $this->createby = $createby;
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
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getPartId()
    {
        return $this->part_id;
    }

    /**
     * @param mixed $part_id
     */
    public function setPartId($part_id)
    {
        $this->part_id = $part_id;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
                "icon" => [
                    "type" => "text",
                    "label" => "Mes icons",
                    "id" => "icon",
                    "class" => "form-control",
                    "placeholder" => "Tapez votre cours ici",
                    "required" => true
                ],
                "code" => [
                    "type" => "textarea",
                    "label" => "Ma leçon",
                    "id" => "code",
                    "class" => "form-control",
                    "placeholder" => "Tapez votre cours ici"
                ]
            ]
        ];
    }
}




