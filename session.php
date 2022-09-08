<?php 
   try{
    $GLOBALS["pdo"]= new PDO('mysql:host=127.0.0.1;dbname=evaluation', 'test','test');
    }catch(Exception $error){
        $error->getMessage();
    } 
?>
