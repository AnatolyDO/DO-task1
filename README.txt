��� ��������� ������. 
��������� ����� ����������, ������������ � ������ �� ��� � MVC.
�������� ������� � ��� �������� � ������ � ��������� MVC.

������ ��������� � ���������� ��������� ����� index.php
� �������� ��� ������������ ��������� �����.
����� ������������ � ������� ������� routing.php
� ��� � �������� URL �� ���������, � ����� ����������� ��������� ������ �������, 
� �������� ������ ��������.
�������������� ��� ����� �������� ��� apache
(
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule .* index.php [L]
)

� ������� http://localhost/table/index
��������� ���� /controlles/controller_table, ������� ��������� ����� ������ � �������� �������� index.
���� ��� ����. 

� ���������� ������������� �������� ����������. Controller - Model - View.

������ ��� ���:

� ������� ����� Model_Search
� �������� ������� (������ �� ���� � ����� ������/������ ������),
� public ��������:
->incData() �������� ������� ������ ���������� 
->search() ������ �� ����� � ������� ������ � ���� ����� private ����� DBinsert
->printOut() ���������� ��������� ������

������ ������������� ������:
������� ��������� � �������� ������� ������������ ������� __construct
$cs = new cURLSearch("$url", "$pattern_inc");

�������������� �����
$cs = new cURLSearch;
$cs->incData("$url", "$pattern_inc");

��������� ����� � ���� ����������� � ���� 
$cs->search();

�������� ��������� �� �����
$cs->printOut();

����� ������� �� ���������� ������ � ������ � �����. 
� ������������ ������������ ���� ������ ����������, ��� ������������.

��������� ������������ ����� ������ ����� ����� ������� �� cURLSearch
� �������: 
class cURLSearchGoogle extends cURLSearch {
	$this->site = "google.com";
}
������� ������. �� ����������� ��� �������� ������� ������, �� ����� ������ ��������� ������.

������������� ���������� ������������� ������������ ������ � ������������ �������, 
������� ��������� ������ ������� ��������� �� ��� ������.
� �������
abstract class search {
	protected $searchMethod;
	abstract public function searchSite();
}
� ������ ����� ������ ������� ����������� ���:
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
� �.�.

������ �������������:
$a = new Links;
$b = new Images;
� �� ����� ������������ ���� � ��� �� ����� ��� ����� �������.
$a->searchSite();
$b->searchSite();

===========================
����������� ���� mySQL
encoding - utf8
��� �������� ������� ����� ������������ ������ createTable.php
============================
�������� ����� ���������� � ������
������ �� ����� �� ������ ���������� ���� � ������ � ������� ������ � ���������
� ���������� ���������� � ����.
��� ����� ����������� jQuery � ������ plusstrap
