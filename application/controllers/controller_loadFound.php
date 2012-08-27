<?php

class Controller_LoadFound {
    
    public $model;
    public $id;
    public $elements;
    
    function __construct() 
    {
        $this->id = $_GET['searchId'];
        
        //$valid_id = filter_var($searchId, FILTER_VALIDATE_INT);
        
        $this->model = new Model_LoadFound($this->id);
    }
    
    public function action_index() 
    {
        $this->elements = $this->model->get_elements();
        echo $this->elements;
        
    }
}
?>
