<?php
    class UserController{
        private $model;
        private $user = false;
        public function __CONSTRUCT(){
            require_once 'model/UserModel.php';
            require_once 'database/Database.php';
            $db = new Database();
            $this->model =  new UserModel( $db );
            $this->user = @$_SESSION['user'];
        }

        public function index(){
            if( !@$_SESSION['user'] ){
                header('Location: ' . base_url());
            }
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
            $response = (object)array('success'=>false, 'message'=>false, 'data'=>false);
            
            if( !$this->model->validate() ){
                $response->message = 'La dirección de correo ya se encuentra en uso';
            }
            else{
                $this->model->id = $this->model->insert();
                $response->success = true;
                $response->message = 'Registro ingresado con éxito';
                $response->data = $this->model;
            }
            echo json_encode($response);
        }

        //  update user
        public function update(){
            $this->model->id = $_POST["id"];
            $this->model->name = $_POST["name"];
            $this->model->last_name = $_POST["last_name"];
            $this->model->email = $_POST["email"];
            $this->model->password = $_POST["password"];
            
            $response = (object)array('success'=>false, 'message'=>false, 'data'=>false);
            if( !$this->model->validate() ){
                $response->message = 'La dirección de correo ya se encuentra en uso';
            }
            else{
                $this->model->update();
                $response->success = true;
                $response->message = 'Registro actualizado con éxito';
                $response->data = $this->model;
            }
            echo json_encode($response);

        }

        //  delete user
        public function delete(){
            $this->model->id = $_POST["id"];
            $this->model->delete();
            $response = (object)array('success'=>true, 'message'=>'Registro eliminado con éxito', $data=>false);
            echo json_encode($response);
        }

    }
?>