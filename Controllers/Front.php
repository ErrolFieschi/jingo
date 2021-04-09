<?php


namespace App\Controller;
use App\Core\View;

class Front
{

public function formAction(){ $view = new View("Front/form", "front"); }
}
