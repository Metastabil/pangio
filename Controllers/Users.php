<?php
namespace Controllers;

class Users extends PangioController {
    public function __construct() {
        parent::__construct();
    }

    public function index() :void {
        $data = [
            'text' => 'Something'
        ];

        $this->view->displayView('Users/index', $data);
    }

    public function create() :void {
        echo 'This is the create method of the Users controller!';
    }
}