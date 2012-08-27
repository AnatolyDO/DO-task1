<?php

class Model_Table {
    
    public $resultObjects;
    
    public function table_data()
    {    
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
        
        $query = "SELECT * FROM search";
        
        $result = $mysqlLink->query($query);  
	
	$mysqlLink->close();
        
        while ($resultObj = $result->fetch_object()) {
            $this->resultObjects[] = $resultObj;
        }
        
        //var_dump($this->resultObjects);
        
        return $this->resultObjects;

    }
        
}
?>
