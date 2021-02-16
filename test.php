<?php 
    $action = 'index';
    $controllerFile =  'Home.php';
    $controllerClass = 'HomeController';

    require 'controller/'. $controllerFile;
    $controller = $controllerClass;
    $controller = new $controller();
    $controller->$action();
?>