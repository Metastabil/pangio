<?php
include __DIR__ . '/System/Pangio.php';

/* System Class Instances */
$pangio = new \Pangio\Pangio();
$config = new Pangio\Config();
$routes = new Pangio\Routes();
$view = new Pangio\View();

$routes->routing();
