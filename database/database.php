<?php
require_once("database-config.php");  
class Database
{
    private $pdo;
    function __construct() {  
    }

    private function _open(){

        try {
            $datasource = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->pdo = new PDO($datasource, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'connected';
        }
        catch (PDOException $e)
        {
            die ($e->getMessage());
        }

    }

    private function _close(){
        $this->pdo = null;
    }
    
    public function test(){
        $this->_open();
        $query = $this->pdo->prepare("SELECT * FROM users");
        $query->execute();
        while($r = $query->fetch(PDO::FETCH_OBJ)){
            echo "Id: " . $r->id . "<br>";
            echo "Nombre: " . $r->name . "<br>";
        }
        $this->_close();
    

    }

}



?>