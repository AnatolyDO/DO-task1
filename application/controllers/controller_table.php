<?php

class Controller_Table {
    
    public $load;
    public $model;
    public $tableData;
    
    function __construct() 
    {
        $this->load = new Load();
        $this->model = new Model_Table();
    }
    
    function action_index() 
    {
        //$this->model->table_data();
        $this->tableData = $this->model->table_data();
        
        $this->load->view('table_view.php', 'template_view.php', $this->tableData);

    }
}
?>
