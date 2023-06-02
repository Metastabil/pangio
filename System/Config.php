<?php
namespace Pangio;

class Config {
    public function __construct() {
        # Source code
    }

    public function getDatabaseConfig() :array {
        $path = dirname(__DIR__) . '/Config/Database.php';

        if (!is_file($path)) die('Error! The following file is missing: Config/Database.php');

        include $path;

        return $database;
    }

    public function getApplicationConfig() :array {
        $path = dirname(__DIR__) . '/Config/Config.php';

        if (!is_file($path)) die('Error! The following file is missing: Config/Config.php');

        include $path;

        return $config;
    }
}