<?php 
   $db_name = 'testing';
   $db_host = '172.20.31.53';
   $db_user = 'relintdev';
   $db_password = 'password';

   $pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

?>