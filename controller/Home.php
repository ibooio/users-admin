<?php
    /*
        Este controlador es el que se llama por defecto
        contiene la lógica del login y el logout
        en caso de login correcto redirecciona a User/index
    */
    class HomeController{
        private $model;
        private $error_message = '';

        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            require_once 'database/Database.php';
            $db = new Database();
            $this->model =  new UserModel( $db );
        }
    
        public function index(){
            $this->error_message = '';
            if( @$_SESSION['user'] ){
                header('Location: ' . base_url('user/index'));
                exit();
            }
            else if (  !empty($_POST)){
                $this->model->email = $_POST['email'];
                $this->model->password = $_POST['password'];
                
                $result = $this->model->login(); 
                if( $result ){
                    $_SESSION['user'] = $result->name . ' ' . $result->last_name;
                    header('Location: ' . base_url('user/index'));
                    exit();
                }
                else{
                    $this->error_message = 'Datos de acces incorrectos';
                    require_once 'view/home/index.php';
                }
            }else{
                require_once 'view/home/index.php';
            }
        }

        public function logout(){
            session_unset();
            session_destroy();
            header('Location: ' . base_url(''));
            exit();
        }
    }
?>