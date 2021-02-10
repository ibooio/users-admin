<?php 
    require_once("database/database.php");  
    $database = new Database();
    echo 'test<br>';
    $database->test();
?>