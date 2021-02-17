<?php
    /*
        Queremos que las urls sean del tipo midominio.com/controlador/metodo
        este archivo, que es el primero en ejecutarse, maneja la lógica necesaria
        para parsear la url, instanciar el controlador necesario y ejecutar el metodo indicado
    */
    if(session_id()=='')
    {
        session_start();
    }
    
    // futuras configuracion podrían ir aquí
    // podría llevarse a otro archivo con configuraciones
    function config(){
        // app_folder sirve para indicar si la aplicación se encuentra en una subcarpeta del servidor
        // ejemplo: midominio.com/users
        // en caso de que no sea el caso, setear app_folder con ''
        //return ['app_folder'=>'otrasubcarpeta/users']; <-- ejemplo con otra subcarpeta
        return ['app_folder'=>'users'];
    }
    
    // función para obtener la url base del proyecto
    // podría llevarse a otro archivo con funciones
    function base_url($url){
        $base_url = !empty($_SERVER['HTTP']) && $_SERVER['HTTP'] == 'on' ? 'https' : 'http';
        $base_url .= '://';
        $base_url .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != '80') {
            $base_url .= ':'.$_SERVER['SERVER_PORT'];
        }
        $app_folder =  config()['app_folder'];
        $base_url.= $app_folder ? '/' . $app_folder : '';
        $base_url.= '/' . $url;
        return $base_url;

    }
    // obtenemos la configuración
    $config =config();
    // contabilizamos la cantidad de carpetas
    $app_folder_parts = !$config['app_folder'] ? 0 : count( explode('/', $config['app_folder']) );

    // obtenemos partes de la url actual
    $args = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI']), function($value) { return !is_null($value) && $value !== ''; }));    

    // obtenemos el nombre del controlador a ejecutar
    $controller = ucfirst(count($args)>$app_folder_parts ? explode('?', $args[$app_folder_parts])[0] : 'home');

    // obtenemos el nombre método a ejecutar
    $action = ucfirst(count($args)> ($app_folder_parts + 1) ? explode('?', $args[$app_folder_parts+1])[0] : 'index');
  
    // incluimos el archivo donde se encuentra el controlador
    require 'controller/'. $controller. '.php';

    // obtenemos la clase del controlador
    $controllerClass = $controller. 'Controller';
    
    // creamos una instancia del controlador
    $instance = new $controllerClass();

    // llamamos al método del controlador
    $instance->$action();
?>