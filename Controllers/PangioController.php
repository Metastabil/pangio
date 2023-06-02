<?php
namespace Controllers;

use Pangio\View;

class PangioController {
    protected View $view;

    public function __construct() {
        $this->view = new View();
    }
}