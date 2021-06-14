<?php


namespace App\Models;


use App\Core\Database;

class Training  extends Database
{
    private $id = null;
    protected $description;
    protected $title;
    protected $createby;
    protected $template = 'default';
    protected $role;
    protected $active = 1;
    protected $fk_training_tag;

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
    public function getFkTrainingTag()
    {
        return $this->fk_training_tag;
    }

    /**
     * @param mixed $fk_training_tag
     */
    public function setFkTrainingTag($fk_training_tag): void
    {
        $this->fk_training_tag = $fk_training_tag;
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

   public function formTraining(){

       return [
           "config" => [
               "method" => "POST",
               "action" => "",
               "id" => "form_training",
               "class" => "add_trainings",
               "submit" => "Ajouter une Leçon"
           ],
           "inputs" => [
               "title" => [
                   "type" => "text",
                   "label" => "Nom de la formation",
                   "minLength" => 2,
                   "maxLength" => 55,
                   "id" => "training_name",
                   "class" => "form_input",
                   "placeholder" => "Nom de la formation",
                   "error" => "Le nom de la page doit faire entre 2 et 55 caractères",
                   "required" => true
               ],
               "description" => [
                   "type" => "textarea",
                   "label" => "Description de la formation",
                   "id" => "training_description",
                   "class" => "form_input",
                   "placeholder" => "Description de la formation",
                   "error" => "",
                   "required" => true
               ],
           ],
       ];
   }
}
