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
    
        private function crypt($func, $text){

            return $func($text, 'AES-128-CTR', 'patagonia', 0, '1234567898765432'); 

        }

        public function get_all(){
            $sql = "Select * FROM users";
            $result = $this->database->select($sql);
            foreach($result as $r){
                $r->id = $this->crypt('openssl_encrypt', $r->id);
            }
            return $result;
        }

        public function insert(){
            $sql = "INSERT INTO users (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => hash('sha512', $this->password),
            ];
            return $this->crypt('openssl_encrypt', $this->database->insert($sql, $data));
        }

        public function update(){
            $sql = "UPDATE users SET name=:name, last_name=:last_name, email=:email " .  ($this->password ? ", password=:password" : "") . " WHERE id=:id";
            $data = [
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => $this->password ? hash('sha512', $this->password) : '',
                'id'=> $this->crypt('openssl_decrypt',$this->id)
            ];                
            $this->database->update($sql, $data);
        }

        public function delete(){
            $sql = "DELETE FROM users WHERE id=:id";
            $data = [ 'id'=> $this->crypt('openssl_decrypt',$this->id) ];
            $this->database->delete($sql, $data);
        }

        public function validate(){
            $sql = "Select COUNT(id) as count FROM users WHERE email='". $this->email ."'";
            if( $this->id ){
                $sql.= " and id !='". $this->crypt('openssl_decrypt',$this->id) ."'";
            }
            $result =  $this->database->select($sql);          
            return $result[0]->count == 0 ? true : false;
        }

        public function login(){
            $sql = "Select * FROM users WHERE email='". $this->email ."' and password='". hash('sha512', $this->password) ."'";
            $result =  $this->database->select($sql);          
            return count($result) == 1 ? $result[0] : false;
        }

    }
?>