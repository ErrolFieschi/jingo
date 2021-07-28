<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Lesson extends Database
{

    private $id = null;
    protected $createby;
    protected $title;
    protected $icon;
    protected $image;
    protected $resume;
    protected $code;
    protected $part_id;
    protected $url ;

    protected $bdd;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = Helpers::stringify($url);
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
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = htmlspecialchars($resume);
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
        $this->title = trim(htmlspecialchars($title));
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
        $this->icon = htmlspecialchars($icon);
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
                "enctype"=>"multipart/form-data",
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
                "resume" => [
                    "type" => "textarea",
                    "label" => "Résumé de la leçon",
                    "id" => "resume",
                    "class" => "form-control",
                    "placeholder" => "Tapez votre résumé ici"
                ],
                "code" => [
                    "type" => "textarea",
                    "label" => "Ma leçon",
                    "id" => "code",
                    "class" => "jingoEditor",
                    "placeholder" => "Tapez votre cours ici"
                ],
                "photo" => [
                    "type" => "file",
                    "label" => "Image de la leçon",
                    "id" => "photoImport",
                    "class" => "form-control"
                ]
            ]
        ];
    }

    public function formUpdateLesson($post = null, $uri = null)
    {

        $data = Database::customSelectFromATable("lesson", "title, resume, code, icon", "id", $post);

        return [

            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "enctype"=>"multipart/form-data",
                "id"=>"form_lesson_2",
                "class"=>"form_input",
                "submit"=>"Mettre à jour cette leçon"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "title",
                    "value" => $data[0]['title'],
                    "class" => "form-control",
                    "error" => "Le titre doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "resume" => [
                    "type" => "textarea",
                    "label" => "Résumé de la leçon",
                    "id" => "resume",
                    "value" => $data[0]['resume'],
                    "class" => "form-control"
                ],
                "code" => [
                    "type" => "textarea",
                    "label" => "Ma leçon",
                    "id" => "code",
                    "value" => $data[0]['code'],
                    "class" => "jingoEditor"
                ],
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "value" => $post,
                    "class" => "form-control"
                ],
                "uri" => [
                    "type" => "hidden",
                    "id" => "uri",
                    "value" => $uri,
                    "class" => "form-control"
                ]
            ]
        ];
    }
}




