<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class Part extends Database
{
    private $id = null;
    protected $title;
    protected $createby;
    protected $icon;
    protected $order_part;
    protected $training_id;
    protected $url ;

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
        $this->title = trim(htmlspecialchars($title));
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
    public function setCreateby($createby): void
    {
        $this->createby = $createby;
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
    public function setIcon($icon): void
    {
        $this->icon = htmlspecialchars($icon);
    }

    /**
     * @return mixed
     */
    public function getOrderPart()
    {
        return $this->order_part;
    }

    /**
     * @param mixed $order_part
     */
    public function setOrderPart($order_part): void
    {
        $this->order_part = $order_part;
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
    public function setTrainingId($training_id): void
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
            ],
        ];
    }

}