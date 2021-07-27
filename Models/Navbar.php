<?php


namespace App\Models;
use App\Core\Database;


class Navbar extends Database
{
    protected $id = null;
    protected $code;
    protected $form;

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
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form): void
    {
        $this->form = $form;
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


    public function updateNavbar(){
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
                "form" => [
                    "type" => "hidden",
                    "label" => "",
                    "id" => "form_save",
                    "class" => "popup_form_input",
                    "placeholder" => ""
                ],
            ],
        ];
    }

}
