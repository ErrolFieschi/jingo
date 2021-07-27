<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Page extends Database
{
    protected $id = null;
    protected $title;
    protected $createBy;
    protected $name;
    protected $code;
    protected $url;
    protected $active;
    protected $meta;
    protected $visible;

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
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param mixed $visible
     */
    public function setVisible($visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta): void
    {
        $this->meta = $meta;
    }

    /**
     * @return null
     */
    public static function getInstance()
    {
        return self::$_instance;
    }

    /**
     * @param null $instance
     */
    public static function setInstance($instance): void
    {
        self::$_instance = $instance;
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
    public function setId($id): void
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
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * @param mixed $createBy
     */
    public function setCreateBy($createBy): void
    {
        $this->createBy = $createBy;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return Database|null
     */
    public function getBdd(): ?Database
    {
        return $this->bdd;
    }

    /**
     * @param Database|null $bdd
     */
    public function setBdd(?Database $bdd): void
    {
        $this->bdd = $bdd;
    }

    public function savePage()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "save_page_id",
                "class" => "save_page button-con mt-20",
                "submit" => "Enregistrer"
            ],
            "inputs" => [
                "code" => [
                    "type" => "hidden",
                    "label" => "",
                    "id" => "code_save",
                    "class" => "popup_form_input",
                    "placeholder" => ""
                ],
            ],
        ];
    }

    public function updatePage($post = null, $uri = null){
        $data = Database::customSelectFromATable("page", "title, name, meta", "id",$post);

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "update_page_id",
                "class" => "div_form_submit",
                "submit" => "Enregistrer"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre de la page",
                    "value" => $data[0]['title'],
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "title_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "name" => [
                    "type" => "text",
                    "label" => "Nom de la page",
                    "value" => $data[0]['name'],
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "name_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "meta" => [
                    "type" => "textarea",
                    "label" => "Mots clefs",
                    "value" => $data[0]['meta'],
                    "minLength" => 2,
                    "maxLength" => 300,
                    "id" => "meta_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 300 caractères",
                    "required" => true
                ],
                "visible" => [
                    "type" => "radio",
                    "label" => "Rendre la formation visible",
                    "id" => "visible",
                    "name" => "showForm",
                    "class" => "",
                    "options" => [
                        "oui" => 1,
                        "non" => 0,
                    ],
                    "placeholder" => "",
                    "error" => "Votre themes doit faire 2 caractères",
                ],
            ],
        ];
    }

    public function createPage()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "add_page_id",
                "class" => "add_page mt-20",
                "submit" => "Enregistrer"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre de la page",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "title_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "name" => [
                    "type" => "text",
                    "label" => "Nom de la page",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "name_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "meta" => [
                    "type" => "textarea",
                    "label" => "Mots clefs",
                    "minLength" => 2,
                    "maxLength" => 300,
                    "id" => "meta_page",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 300 caractères",
                    "required" => true
                ],
                "visible" => [
                    "type" => "radio",
                    "label" => "Rendre la formation visible",
                    "id" => "visible",
                    "name" => "showForm",
                    "class" => "",
                    "options" => [
                        "oui" => 1,
                        "non" => 0,
                    ],
                    "placeholder" => "",
                    "error" => "Votre themes doit faire 2 caractères"
                ],
            ],
        ];
    }


}
