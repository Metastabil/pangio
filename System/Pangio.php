<?php
namespace Pangio;

class Pangio {
    public function __construct() {
        $this->initializeSystemClasses();
        $this->initializeControllers();
        $this->initializeModels();
        $this->defineConstants();
    }

    private function initializeSystemClasses() :void {
        $allSystemClasses = scandir(__DIR__);
        $thisFileArrayKey = array_search('Pangio.php', $allSystemClasses);

        unset($allSystemClasses[0]);
        unset($allSystemClasses[1]);
        unset($allSystemClasses[$thisFileArrayKey]);

        foreach ($allSystemClasses as $systemClass) {
            include __DIR__ . '/' . $systemClass;
        }
    }

    private function initializeControllers() :void {
        $allControllers = scandir(dirname(__DIR__) . '/Controllers');
        unset($allControllers[0]);
        unset($allControllers[1]);

        foreach ($allControllers as $controller) {
            include dirname(__DIR__) . '/Controllers/' . $controller;
        }
    }

    private function initializeModels() :void {
        $allModels = scandir(dirname(__DIR__) . '/Models');
        unset($allModels[0]);
        unset($allModels[1]);

        foreach ($allModels as $model) {
            include dirname(__DIR__) . '/Models/' . $model;
        }
    }

    private function defineConstants() :void {
        $config = new Config();
        $applicationConfig = $config->getApplicationConfig();

        define('BASE_URL', $applicationConfig['baseURL']);
    }
}