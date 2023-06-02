<?php
namespace Models;

use Pangio\Database;

class PangioModel {
    protected Database $db;

    public function __construct() {
        $this->db = new Database();
    }
}