<?php
namespace Pangio;

class View {
    public function __construct() {
        # Source code
    }

    public function displayView(string $location, array $variables = []) :void {
        $path = dirname(__DIR__) . '/Views/' . $location . '.php';

        if (!is_file($path)) die('The requested view ' . $location . '.php does not exist!');

        extract($variables);
        ob_start();

        include $path;

        $output = ob_get_clean();

        echo $output;
    }
}