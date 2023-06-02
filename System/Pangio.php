<?php
namespace Pangio;

class Pangio {
    public function __construct() {
        $this->initializeSystemClasses();
        $this->initializeControllers();
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
}