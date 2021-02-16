<?php
    if(session_id()=="")
    {
        session_start();
    }

    function config(){
        //return ['app_folder'=>'otrasubcarpeta/users']; <-- ejemplo con otra subcarpeta
        return ['app_folder'=>'users'];
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
    $app_folder_parts = !$config['app_folder'] ? 0 : count( explode("/", $config['app_folder']) );
    $args = array_values(array_filter(explode("/", $_SERVER["REQUEST_URI"]), function($value) { return !is_null($value) && $value !== ''; }));    

    $controller = ucfirst(count($args)>$app_folder_parts ? explode("?", $args[$app_folder_parts])[0] : "home");
    $action = ucfirst(count($args)> ($app_folder_parts + 1) ? explode("?", $args[$app_folder_parts+1])[0] : "index");
    
    require 'controller/'. $controller. '.php';
    $controllerClass = $controller. 'Controller';
    
    $instance = new $controllerClass();
    $instance->$action();
?>