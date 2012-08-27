<?php

class Controller_Form {
    
    public $load;
    
    function __construct() {
        
        $this->load = new Load();
    }
    
    function action_index() {
        $this->load->view('form_view.php', 'template_view.php');
    }
    
        
}
?>
