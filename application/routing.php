<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

class routing {
    
    private $default_controller = 'Form';
    private $default_action = 'index';
    
    private $controller_prefix = 'Controller_';
    private $action_prefix = 'action_';
    private $model_prefix = 'Model_';
    
    
    //разбиваем путь на части. и переводим его в контроллер и экшен
    //вида: localhost/controller/action
    function __construct() 
    {
        //echo "route: " . $_SERVER['REQUEST_URI'] . "<br>";
        //$path = $_SERVER['REQUEST_URI'];
        //var_dump($path);
        //разбиваем запрошенную ссылку в переменную routes
        $this->routes = explode('/', $_SERVER['REQUEST_URI']);
        //если параметров больше 2, вылетаем
        if (count($this->routes)>3) die ('Непредусмотренный маршрут!');
        
        //первый параметр имя контроллера
        if (!empty($this->routes[1])) {
            //отделим значения до параметров GET
            $contName = explode('?', $this->routes[1]); 
            $this->controller_name = $contName[0];
        } else {
            $this->controller_name = $this->default_controller;
        }
        
        //второй параметр имя экшена
        if (!empty($this->routes[2])) {
            //отделим значения до параметров GET
            $actName = explode('?', $this->routes[2]); 
            $this->action_name = $actName[0];
        } else {
            $this->action_name = $this->default_action;
        }
        
        //добавляем префиксы 
        $this->model_name = $this->model_prefix . $this->controller_name;
        $this->controller_name = $this->controller_prefix . $this->controller_name;
        $this->action_name = $this->action_prefix . $this->action_name;
        
        $this->run();
    }
    
    function run() 
    {
        //подцепляем файл с классом модели
        $model_file = strtolower($this->model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path)) {
            include "models/".$model_file;
            //echo "models/".$model_file . '</br>';   //TESTING
        }
        //файла модели может и не быть
        
        //подцепляем файл с классом контроллера
        $controller_file = strtolower($this->controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if (file_exists($controller_path)) {
            include "controllers/".$controller_file;
            //echo "controllers/".$controller_file . '</br>';      //TESTING
        } else {
            echo $controller_path;
            die ('Такого контроллера не существует!');
        }
        //здесь можно кинуть исключение
        
        //создаем контроллер и вызываем экшен
        $controller = new $this->controller_name;
        $action = $this->action_name;
        //echo $action;   //TESTING
        
        //проверяем есть ли указанный метод в выбранном классе.
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            die('Такого экшена не существует!'); 
        }
        //здесь можно кинуть исключение
    }
}

?>
