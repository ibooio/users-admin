<?php
require_once("database-config.php");  
class Database
{
    private $pdo;
    private function _open(){
        try {
            $datasource = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->pdo = new PDO($datasource, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die ($e->getMessage());
        }
    }

    private function _close(){
        $this->pdo = null;
    }

    public function run($sql, $data){
        $this->_open();
        $this->pdo->prepare($sql)->execute($data);
        $this->_close();
    }

}



?>