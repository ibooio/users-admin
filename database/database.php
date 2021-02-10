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

    private function run_generic($sql, $data){
        $this->_open();
        $st=  $this->pdo->prepare($sql)->execute($data);
        $this->_close();
    }

    public function insert($sql, $data){  $this->run_generic($sql, $data); }
    public function update($sql, $data){  $this->run_generic($sql, $data); }
    public function delete($sql, $data){  $this->run_generic($sql, $data); }
    public function select($sql){
        $this->_open();
        $st = $this->pdo->query($sql);
        $result= array();
        while ($row = $st->fetch(PDO::FETCH_OBJ)) {
            $result[]=$row;
        }
        $this->_close();
        return $result;
    }

}



?>