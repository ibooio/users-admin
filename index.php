<?php
    if(session_id()=="")
    {
        session_start();
    }

    function config(){
        return ['app_folder'=>'users-admin'];
    }
    
    function base_url($url){
        
        $base_url = !empty($_SERVER["HTTP"]) && $_SERVER["HTTP"] == "on" ? "https" : "http";
        $base_url .= "://";
        $base_url .= $_SERVER["SERVER_NAME"];
        if ($_SERVER["SERVER_PORT"] != "80") {
            $base_url .= ":".$_SERVER["SERVER_PORT"];
        }
        $app_folder =  config()['app_folder'];
        $base_url.= $app_folder ? '/' . $app_folder : '';
        $base_url.= '/' . $url;
        return $base_url;

    }
    $config =config();

    // set null si se encuentra en el root del server    
    // obtenemos los elementos de la url
    // descartamos los nulos
    $args = array_values(array_filter(explode("/", $_SERVER["REQUEST_URI"]), function($value) { return !is_null($value) && $value !== ''; }));    
    $controller = !$config['app_folder'] ? ( count($args)>0 ? explode("?", $args[0])[0] : "home" ): ( count($args)>1 ? explode("?", $args[1])[0] : "home" );
    $action =     !$config['app_folder'] ? ( count($args)>1 ? explode("?", $args[1])[0] : "index" ): ( count($args)>2 ? explode("?", $args[2])[0] : "index" );
    //$controller = $config['app_folder'] ? (  count($args)>2 ?  explode("?", $args[1])[0] : "home" ) : (count($args)>0 ?  explode("?", $args[1])[0]: "home");
    //$action =     $config['app_folder'] ? (  count($args)>2 ? explode("?", $args[2])[0] :  "index" ) : (count($args)>1 ?  explode("?", $args[1]): "main");
    //echo $args[2];
    //echo  $controller . ' ' . $action;
    //echo  $action;
    $controllerFile = $controller. '.php';
    $controllerClass = $controller. 'Controller';


    require 'controller/'. $controllerFile;
    $controller = $controllerClass;
    $controller = new $controller();
    $controller->$action();
?>