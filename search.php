<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 		
	$url = $_POST['siteToSearch'];
	$pattern_inc = $_POST['searchPattern'];
	
    function __autoload($class_name) {
        include_once 'class.' . $class_name . '.php';
    }

    //создаем экземпляр класса  cURLSearch с входными данными
    $cs = new cURLSearch("$url", "$pattern_inc");
    
    //альтернативный метод смены входных данных в объекте
    //$cs->incData("google.com", "goog"); 

    //выполняем поиск и внос результатов в базу 
    $cs->search();
    //печатаем результат на экран
    $cs->printOut();
    
?>