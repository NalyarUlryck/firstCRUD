<?php 
   $db_name = 'test';
   $db_host = 'localhost';
   $db_user = 'root';
   $db_password = '';

   $pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

?>