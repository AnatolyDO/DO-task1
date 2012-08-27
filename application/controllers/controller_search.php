<?php

class Controller_Search {
    
    public $model;
    private $url;
    private $pattern_inc;
    
    function __construct() 
    {
    
        $this->url = $_POST['siteToSearch'];
        $this->pattern_inc = $_POST['searchPattern'];
        
        $this->model = new Model_Search($this->url, $this->pattern_inc);  
    
    }
    
    function action_index() 
    {
        if ($this->model->siteValidate($this->url)) {
            $this->model->search();
            $this->model->printOut();
        } else {
            echo 'Site Not valid';
        }
    }
    
}
    
?>
