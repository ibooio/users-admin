<?php
    class HomeController{
        private $model;
        private $error_message = "";

        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            require_once 'database/Database.php';
            $db = new Database();
            $this->model =  new UserModel( $db );
        }
    
        public function index(){

            if( @$_SESSION['user'] ){
                header('Location: ' . base_url('user'));
            }
            else if (  !empty($_POST)){
                $this->model->email = $_POST["email"];
                $this->model->password = $_POST["password"];
                
                $result = $this->model->login(); 
                if( $result ){
                    $_SESSION['user'] = $result->name . ' ' . $result->last_name;
                    header('Location: ' . base_url('user'));
                }
                else{
                    require_once 'view/home/index.php';
                }
            }else{
                require_once 'view/home/index.php';
            }
        }

        public function logout(){
            session_unset();
            session_destroy();
            header('Location: ' . base_url());
        }
    }
?>