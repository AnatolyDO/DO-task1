<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        $mysqlLink->query("SET CHARACTER SET utf8");
	
	$query="CREATE TABLE search (
		id		 int(6)	 		 NOT NULL	 auto_increment, 
		url		 varchar(35)	 NOT NULL,
		elements varchar(1500)	 NOT NULL,
		num 	 varchar(20)	 NOT NULL,
		PRIMARY KEY(id),
		UNIQUE id (id),			
		KEY id_2(id)	
		)";
	
        $mysqlLink->query($query);
	$mysqlLink->close();
		
		
?>