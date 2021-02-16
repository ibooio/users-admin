<?php
    class UserModel{
        private $database;
        public $id ;
        public $name;
        public $last_name;
        public $email;
        public $password;

        function __construct($database) {  
            $this->database = $database;
        }
    
        public function get_single(){

        }

        public function get_all(){
            $sql = "Select * FROM users";
            return $this->database->select($sql);
        }

        public function insert(){
            $sql = "INSERT INTO users (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password,
            ];
            return $this->database->insert($sql, $data);
        }

        public function update(){
            $sql = "UPDATE users SET name=:name, last_name=:last_name, email=:email, password=:password WHERE id=:id";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password,
                'id'=>$this->id
            ];
            $this->database->update($sql, $data);
        }

        public function delete(){
            $sql = "DELETE FROM users WHERE id=:id";
            $data = [ 'id'=>$this->id ];
            $this->database->delete($sql, $data);
        }

        public function validate(){
            $sql = "Select COUNT(id) as count FROM users WHERE email='". $this->email ."'";
            if( $this->id ){
                $sql.= " and id !='". $this->id ."'";
            }
            $result =  $this->database->select($sql);          
            return $result[0]->count == 0 ? true : false;
        }

    }
?>