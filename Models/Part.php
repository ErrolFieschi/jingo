<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Part extends Database
{
    private $id = null;
    private $title;
    protected $createby;
    private $icon;
    private $order;
    protected $training_id;
    protected $url ;

    public function __construct()
    {
        $this->bdd = parent::getInstance();
        $getCalledClassExploded = explode("\\", get_called_class());
        $this->bdd->setTable(strtolower(DBPREFIXE . end($getCalledClassExploded)));
    }

    /**
     * @return int
     */
    public function getCreateby(): String
    {
        return $this->createby;
    }

    /**
     * @param String $createby
     */
    public function setCreateby(String $createby)
    {
        $this->createby = $createby;
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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getTrainingId()
    {
        return $this->training_id;
    }

    /**
     * @param mixed $training_id
     */
    public function setTrainingId($training_id)
    {
        $this->training_id = $training_id;
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
    public function setUrl($url)
    {
        $this->url = Helpers::stringify($url);
    }

    public function formPart()
    {

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_part",
                "class" => "add_trainings col-sm-12 row",
                "submit" => "Ajouter une Formation"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre du chapitre",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "part_name",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "icon" => [
                    "type" => "text",
                    "label" => "Icon du chapitre",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "part_icon",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
            ],
        ];
    }

}