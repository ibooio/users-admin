<?php
    // set null si se encuentra en el root del server
    $app_folder = 'users';
    // obtenemos los elementos de la url
    // descartamos los nulos
    $args = array_values(array_filter(explode("/", $_SERVER["REQUEST_URI"]), function($value) { return !is_null($value) && $value !== ''; }));
    
    // identificamos el controlador y la acción a ejecutar
    $controller = $app_folder ? (count($args)>1 ?  explode("?", $args[1])[0] : "home") : (count($args)>0 ?  explode("?", $args[2])[0]: "home");
    $action = $app_folder ? (count($args)>2 ? explode("?", $args[2])[0] :  "index") : (count($args)>1 ? explode("?",$args[1]): "index");
    
    $controllerFile = $controller. '.php';
    $controllerClass = $controller. 'Controller';

    require 'controller/'. $controllerFile;
    $controller = $controllerClass;
    $controller = new $controller();
    $controller->$action();
?>
