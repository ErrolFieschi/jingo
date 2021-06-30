<?php


namespace App\Models;


use App\Core\Database;
use App\Core\Helpers;

class Training extends Database
{
    private $id = null;
    protected $description;
    protected $title;
    protected $createby = 1;
    protected $template;
    protected $role = 0;
    protected $active = 1;
    protected $url;
    protected $training_tag_id;

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
     * @return mixed
     */
    public function getTrainingTagId()
    {
        return $this->training_tag_id;
    }

    /**
     * @param mixed $TrainingTagId
     */
    public function setTrainingTagId($training_tag_id)
    {
        $this->training_tag_id = $training_tag_id;
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
    public function setDescription($description): void
    {
        $this->description = $description;
    }


    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive(int $active): void
    {
        $this->active = $active;
    }


    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
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
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function formTraining()
    {

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_training",
                "class" => "add_trainings col-sm-12 row",
                "submit" => "Ajouter une Formation"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Nom de la formation",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "training_name",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "description" => [
                    "type" => "textarea",
                    "label" => "Description de la formation",
                    "id" => "training_description",
                    "class" => "popup_form_input",
                    "placeholder" => "",
                    "error" => "",
                    "required" => true
                ],
                "themes" => [
                    "type" => "select",
                    "label" => "Themes",
                    "id" => "training_themes",
                    "class" => "popup_form_input",
                    "options" => self::getListThemes(),
                    "minLength" => 0,
                    "maxLength" => 1000,
                    "placeholder" => "",
                    "error" => "Votre themes doit faire 2 caractères"
                ],
                "template" => [
                    "type" => "radio",
                    "label" => "",
                    "id" => "template",
                    "name" => "templating",
                    "class" => "popup_form_input",
                    "options" => self::getListTemplates(),
                    "placeholder" => "",
                    "error" => "Votre themes doit faire 2 caractères",
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


    private function getListThemes()
    {
        $data = Database::customSelectFromATable('training_tag', 'name');
        $themes = [];
        foreach ($data as $key => $datas) {
            $themes [$key + 1] = $datas['name'];
        }
        return $themes;
    }

    private function getListTemplates()
    {
        $dir = 'Views/FrontTemplate';
        $templates = [];
        foreach (scandir($dir) as $key => $svg) {
            $svg_name = substr($svg, 0, strpos($svg, '.'));
            if ($svg_name != null) {
                $templates [$key + 1] = $svg_name;
            }
        }
        return $templates;
    }
}
