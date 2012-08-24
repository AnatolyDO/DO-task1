<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

	$ud_id=$_GET['d_id'];
        
        include('dbconnect.php');
        
        $query = "DELETE FROM search WHERE id='$ud_id'";
	
	if($mysqlLink->query($query)){
		header('Location:output.html');
	} else {
		echo "Delete failed <br/>";
	}

	$mysqlLink->close();
?>