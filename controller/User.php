<?php
    class UserController{
        private $model;
        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            $this->model =  new UserModel();
        }
    
        public function Index(){
            require_once 'view/user/index.php';
            $result = $this->model->get_all();
            echo json_encode($result);
        }


    }
?>