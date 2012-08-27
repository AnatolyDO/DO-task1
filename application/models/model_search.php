<?php

class Model_Search {    
        
    private $site = "Empty";  // URL для поиска
    private $patern = "Empty";  // метод поиска
    private $regExpString; // Регулярное выражение поска составляется в зависимости от пришедшего метода.
    private $whatWhere; // Дополнительная переменная для удобства просмотра таблицы поиска. (Можно убрать чтобы не мешалась в базе)
    private $resultNum; //Количество совпадений
    private $resultArray; //Массив найденных элементов сгенерированный preg_match_all
    private $resultString; // Строка найденных элементов
        
    //При создании экземпляра присваиваем сайт и метод.
    public function __construct($site, $patern) 
    {
        
        if ($site) {
            $this->site = $site;
        }
        if ($patern) {
            $this->patern = $patern;            
        }
    }
    
    //Метод смены входных значений у того же объекта.
    public function incData($site, $patern) 
    {
        $this->site = $site;
        $this->patern = $patern;
    }
    
    //проверяем какой код возвращает сайт
    public function siteValidate($chURL) 
    {	
	if ($chURL == NULL) {
            return false;
        } else {	
            $chURL = curl_init($chURL);
            curl_setopt($chURL, CURLOPT_TIMEOUT, 5);
            curl_setopt($chURL, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($chURL, CURLOPT_RETURNTRANSFER, true);
            curl_exec($chURL);
            $httpcode = curl_getinfo($chURL, CURLINFO_HTTP_CODE);
            curl_close($chURL);
            if ($httpcode >= 200 && $httpcode < 400) {
                    return true;
                    //echo 'site valid';
            } else {
                    return false;
                    //echo 'site not valid';
            }
        }
    }
    
    //Метод возвращает содержимое сайта
    private function cUrl($url) 
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 220); // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, 220);        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа

        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;

        $subject = $header['content'];

        return $subject;
    }
    
    //выбираем шаблон поиcка в зависимости от выбранного метода
    private function setRegExpString() 
    {
        switch ($this->patern) {
            case "findLinks":
                $this->regExpString = '/(?<=href\=\")[\w\s\:\(\)\;.\?\_\/\.\=\&\%]+(?=\")/';
                $this->whatWhere = " (links)";
                break;
            case "findImages":
                $this->regExpString = '/(?<=\"|\()[\w\/\.]+\.(png|gif|jpg|jpeg)(?=\"|\))/';
                $this->whatWhere = " (images)";
                break;
            default:
                $this->regExpString = "/".$this->patern."/i";
                $this->whatWhere = " (string)";
                break;
        }
    }
    
    //добавляем результат поиска в базу
    private function DBinsert($itemString, $num) 
    {
        
        $maxStringLength = 1500;//проверяем длинну строки
        if (strlen($itemString) <= $maxStringLength) {

            //include('dbconnect.php');
            $user	= "root";
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
            $mysqlLink->query( "SET CHARACTER SET utf8");

            $query = "INSERT INTO search VALUES (
                    '',
                    '$this->site $this->whatWhere',
                    '$itemString',
                    '$num'
            )";

            if ($mysqlLink->query($query)) {
                echo "Data inserted</br>";
            } else {
                echo "Data not inserted</br>";
            }

            $mysqlLink->close();
	} else {
            echo "<b>Строка слишком длинна чтобы внести в базу, максимальный размер строки = ".$maxStringLength.'</b>';
	}        
    }
    
    //Метод проверяет отвечает ли сайт, присваивает нужный метод поиска и отправляет результаты поиска а базу через private метод DBinsert
    public function search() 
    {
        if ($this->siteValidate($this->site)){ //Проверяем валидность сайта
            
            $this->setRegExpString();  //Задаем строку поиска в зависимости от выбранного метода поиска
            $subject = $this->cUrl($this->site); //скачиваем содержимое страницы
                        
            preg_match_all($this->regExpString, $subject, $this->resultArray); //ищем на странице строку поиска
            $this->resultNum = count($this->resultArray[0]); //количество совпадений
            
            //Если был поиск картинок или ссылок выдаем найденные элементы, 
            //если произвольную строку, выдаем только шаблон поиска
            if ($this->patern == "findLinks" || $this->patern == "findImages") {                
                $this->resultString = "";
                foreach ($this->resultArray[0] as $item) {
                        $this->resultString = $this->resultString.$item.' ';                        
                }                
            } else {
                $this->resultString = $this->patern;
            }
            
            $this->DBinsert($this->resultString, $this->resultNum);
        } else {
            echo "Site not valid or not responding";
        }
    }
    
    public function printOut() 
    {
        echo "Количество совпадений: <b>".$this->resultNum."</b><br/><br/>";
        if ($this->patern == "findLinks" || $this->patern == "findImages") {     
            foreach ($this->resultArray[0] as $item) {
                echo ($item."<br/>");
            }
        } else {
            echo "Шаблон поиска: ".$this->patern."<br/><br/>";
        }
    }

    public function echoData() 
    {
        echo $this->site . $this->patern;
    }
    
}

?>