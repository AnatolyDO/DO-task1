<?php

class Model_LoadFound {
    
    private $id;
    public $resultObj;
    
    public function __construct($id) 
    {
        $this->id = $id;
    }

    public function get_elements() 
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
        
        $query = "SELECT elements FROM search WHERE id = $this->id";

        $result = $mysqlLink->query($query);        

        $mysqlLink->close();

        //var_dump($resultObj);
        $this->resultObj = $result->fetch_object();
        return $this->resultObj->elements;
    }
    
}
?>
