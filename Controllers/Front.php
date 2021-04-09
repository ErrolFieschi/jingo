<?php


namespace App\Controller;

use App\Core\View;

class Front
{

    public function formAction()
    {
        $view = new View("Front/form", "front");
    }

    public function rdvAction()
    {
        $view = new View("Front/rdv", "front");
    }

    public function anniversaireAction()
    {
        $view = new View("Front/anniversaire", "front");
    }

    public function calendrierAction()
    {
        $view = new View("Front/calendrier", "front");
    }

    public function modelAction()
    {
        $view = new View("model", "front");
    }

}
