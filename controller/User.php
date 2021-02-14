<?php
    class UserController{
        private $model;
        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            require_once 'database/Database.php';
            $db = new Database();
            $this->model =  new UserModel( $db );
        }

        public function Index(){
            require_once 'view/user/index.php';
        }

        // get all users
        public function get_all(){
            $result = $this->model->get_all();
            echo json_encode($result);
        }

        // insert user
        public function insert(){
            $this->model->name = $_POST["name"];
            $this->model->last_name = $_POST["last_name"];
            $this->model->email = $_POST["email"];
            $this->model->password = $_POST["password"];
            $this->model->id = $this->model->insert();
            echo json_encode($this->model);
        }

        //  update user
        public function update(){
            $this->model->id = $_POST["id"];
            $this->model->name = $_POST["name"];
            $this->model->last_name = $_POST["last_name"];
            $this->model->email = $_POST["email"];
            $this->model->password = $_POST["password"];
            $this->model->update();
            echo json_encode($this->model);
        }

        //  delete user
        public function delete(){
            $this->model->id = $_POST["id"];
            $this->model->delete();
            echo json_encode(true0);
        }

    }
?>