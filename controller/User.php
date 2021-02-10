<?php
    class UserController{
        private $model;
        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            $this->model =  new UserModel();
        }
    
        public function Index(){
            //test database
            // insert
            /*$this->model->name = "name";
            $this->model->last_name = "last_name";
            $this->model->email ="email";
            $this->model->password ="password";
            $this->model->insert();*/
            
            // update
            /*$this->model->id=3;
            $this->model->name = 'update1';
            $this->model->last_name = 'update2';
            $this->model->email = 'update3';
            $this->model->password = 'update4';
            $this->model->update();*/

            // delete
            /*$this->model->id=3;
            $this->model->delete();*/

            require_once 'view/user/index.php';
        }

        // retorna todos los usuarios
        public function get_all(){
            $result = $this->model->get_all();
            echo json_encode($result);
        }

        // insert un nuevo usuario
        public function insert(){
            $this->model->name = $_POST["name"];
            $this->model->last_name = $_POST["last_name"];
            //$this->model->email = $_POST["email"];
            $this->model->email ="test";
            $this->model->password ="test2";
            $this->model->insert();            
        }

        //  update usuario
        public function update(){
            $this->model->id = $_POST["id"];
            $this->model->name = $_POST["name"];
            $this->model->last_name = $_POST["last_name"];
            $this->model->email = $_POST["email"];
            $this->model->update();
        }

        //  delete usuario
        public function delete(){
            $id = $_POST["id"];
            $this->model->delete($id);
        }

    }
?>