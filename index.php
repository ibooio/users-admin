<?php
    $login=false;

    // con sesion iniciada el controlador es User
    // sin sesion iniciada el controlador es Home

    $controller = $login ? "User" : "Home";
    
    $controllerFile = $controller. '.php';
    $controllerClass = $controller. 'Controller';

    require 'controller/'. $controllerFile;
    $controller = $controllerClass;
    $controller = new $controller();
    $controller->Index();
?>
