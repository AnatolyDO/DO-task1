<?php
	$user		= "root";
	$password	= "password";
	$database	= "mydb";
     
        //подключаемся 
        $mysqlLink = new mysqli;
        $mysqlLink->connect("localhost", $user, $password, $database);

        if ($mysqlLink->connect_errno) {
            echo "</br>Connect to DB failed ";// . $mysqlLink->connect_error;
        }

        //если проблемы с кодировкой...
        $mysqlLink->query("SET NAMES utf8");
        $mysqlLink->query( "SET CHARACTER SET utf8");

?>