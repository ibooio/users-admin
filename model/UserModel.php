<?php
    class UserModel{
        public $id ;
        public $name;
        public $last_name;
        public $email;
        public $password;

        function __construct() {  
            require_once 'database/Database.php';
        }
    
        public function get_single(){

        }

        public function get_all(){
            return array(
                1,2,3,4,5
            );
        }

        public function insert(){
            $db = new Database();
            $sql = "INSERT INTO users (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password,
            ];
            $db->run($sql, $data);
        }

        public function update(){
            $db = new Database();
            $sql = "UPDATE users SET name=:name, last_name=:last_name, email=:email, password=:password WHERE id=:id";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password,
                'id'=>$this->id
            ];
            $db->run($sql, $data);

            
            //$sql = "DELETE FROM `table` WHERE id = ?";        
        }

        public function delete(){
            $db = new Database();
            $sql = "DELETE FROM users WHERE id=:id";
            $data = [ 'id'=>$this->id ];
            $db->run($sql, $data);
        }

    }
?>