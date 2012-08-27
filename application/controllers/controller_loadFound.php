<?php

class Controller_LoadFound {
    
    public $model;
    public $id;
    public $elements;
    
    function __construct() 
    {
        $this->id = $_GET['searchId'];
        
        if (filter_var($this->id, FILTER_VALIDATE_INT)) {
           $this->model = new Model_LoadFound($this->id); 
        } else {
            echo 'id is not int';
        }
        
        
    }
    
    public function action_index() 
    {
        $this->elements = $this->model->get_elements();
        echo $this->elements;
        
    }
}
?>
