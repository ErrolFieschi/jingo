<?php


namespace App\Models;


class Page
{
    private $name;
    private $title;
    private $controller = "Front";
    private $action = "defaultAction";

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

        // IMPORTANT supprimer tout les caractères spéciaux et les espaces
        // verifier os du serveur pour création de chemin probleme des "/" ?
        $cursor = -2;

        $create = fopen("Views/Front/" . $this->name . ".view.php", "a+");
        fclose($create);

        $addController = fopen("Controllers/" . $this->controller . ".php", "r+");
        fseek($addController, $cursor, SEEK_END);
        fputs($addController, PHP_EOL . PHP_EOL . "public function " . $this->name . 'Action(){ $view = new View("' . $this->name . '", "front"); }' . PHP_EOL . "}");
        fclose($addController);

        $addYaml = fopen("routes.yml", "r+");
        fseek($addYaml, 0, SEEK_END);
        fputs($addYaml, "/$this->name:" .
            PHP_EOL . "  controller: " . $this->controller .
            PHP_EOL . "  action: " . $this->name .
            PHP_EOL . "  auth: " . "false"
        );
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
