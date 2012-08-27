<?php
class Load {
    public $template;
    
    function view($content_file, $template_file, $data = null)
    {        
        // динамически подключаем шаблон отображения (вид) и добавляем контент
        include 'application/views/'.$template_file;
    }
}
?>