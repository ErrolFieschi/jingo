<?php


namespace App\Controller;
use App\Core\FormValidator;
use App\Core\View;

class Page
{
    public function createPageAction(){
        $view = new View("page","page");
        $directory = 'Content/Images/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        $img_dir = [];
        foreach ($scanned_directory as $key => $dir) {
            $img_dir[$key + 1] = $directory.$dir;
        }
        $view->assign("img_dir", $img_dir);
    }

}
