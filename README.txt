Выполнил задание с ООП подходом 
Написал класс cURLSearch,
с входными данными (ссылка на сайт и метод поиска/строка поиска),
с public методами:
->incData() поменять входные данные экзмепляра 
->search() искать по сайту и занести данные в базу через private метод DBinsert
->printOut() Напечатать найденные данные

Пример использования класса:
создаем экземпляр с входными данными принимаемыми методом __construct
$cs = new cURLSearch("$url", "$pattern_inc");

альтернативный метод
$cs = new cURLSearch;
$cs->incData("$url", "$pattern_inc");

выполняем поиск и внос результатов в базу 
$cs->search();

печатаем результат на экран
$cs->printOut();

Таким образом мы объединили данные и методы в класс. 
А пользователю предоставили лишь рычаги управления, это инкапсуляция.

Применить наследование можно создав новый класс потомок от cURLSearch
К примеру: 
class cURLSearchGoogle extends cURLSearch {
	$this->site = "google.com";
}
частный случай. Он унаследовал все свойства старого класса, но имеет другие начальный данные.

Полиморфизмом называется использование абстрактного класса с недостающими данными, 
которые дополняют классы потомки созданные на его сонове.
к примеру
abstract class search {
	protected $searchMethod;
	abstract public function searchSite();
}
и теперь пишем классы потомки дополняющие его:
class Links extends search {
	$this->searchMethod = "searchLinks";
	public function searchSite() {
		cURLSearch("google.com", $this->searchMethod);
	}
}

class Images extends search {
	$this->searchMethod = "searchImages";
	public function searchSite() {
		cURLSearch("google.com", $this->searchMethod);
	}
}
И т.д.

Пример использования:
$a = new Links;
$b = new Images;
и мы можем использовать один и тот же метод для обоих классов.
$a->searchSite();
$b->searchSite();