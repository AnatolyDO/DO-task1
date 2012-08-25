<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 

	include('dbconnect.php');
	
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