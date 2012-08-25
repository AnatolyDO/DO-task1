<?php
    
    $searchId = $_GET['searchId'];
    
	include('dbconnect.php');
	                
        $query = "SELECT elements FROM search WHERE id = $searchId";
        
        $result = $mysqlLink->query($query);        

	$mysqlLink->close();
        
	//var_dump($resultObj);
        $resultObj = $result->fetch_object();
        echo $elements = $resultObj->elements;
        

?>
