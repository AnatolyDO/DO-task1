// JavaScript Document
var isCSS, isW3C, isIE4, isNN4;

function initDHTMLAPI() {
	if(document.images)	 {
		isCSS = (document.body && document.body.style) ? true : false;
		isW3C = (isCSS && document.getElementById) ? true : false;
		isIE4 = (isCSS && document.all) ? true : false ;
		isNN4 = (document.layers) ? true : false;
		isIE6CSS = (document.compatMode && document.compatMode.indexOf("CSS1") >= 0) ? true : false;
		}
	window.onload = initDHTMLAPI;
}

function getRawObject(obj) 	{
	var theObj;
	if(typeof obj == "string") {
		if(isW3C) {
				theObj = document.getElementById(obj);
		} 
		else if(isIE4) {
				theObj = document.all(obj);
		} 
		else if(isNN4) 	{
				theObj = seekLayer(document, obj);
		}
} 
	else {			
		theObj = obj;
		}
	return theObj;
}

//Проверка введенного сайта  
function checkSite(form) {
	if (/^(http(s?)\:\/\/){0,1}([\w\d\-]+\.{1})+[\w]{2,3}(\/{1}[\w\&\+\=\?\-\#\.\,]*)*$/i.test(form.siteToSearch.value)){
		form.selectSearchMethod.style.display = 'inline';
		getRawObject('spanMethod').style.display = 'inline-block';
		if (form.selectSearchMethod.value == 'selectCustom') {
			form.searchPattern.style.display = 'inline';		
			getRawObject('spanPattern').style.display = 'inline-block';
		}
	} else {
		form.selectSearchMethod.style.display = 'none';
		getRawObject('spanMethod').style.display = 'none';		
		form.searchPattern.style.display = 'none';
		getRawObject('spanPattern').style.display = 'none';
	}
}


function searchMethod(form) {
	if (form.selectSearchMethod.value == 'selectLinks') {
		form.searchPattern.style.display = 'none';
		
		getRawObject('spanPattern').style.display = 'none';
	}
	if (form.selectSearchMethod.value == 'selectPictures') {
		form.searchPattern.style.display = 'none';
		
		getRawObject('spanPattern').style.display = 'none';
	}
	if (form.selectSearchMethod.value == 'selectCustom') {
		form.searchPattern.style.display = 'inline';		
		getRawObject('spanPattern').style.display = 'inline-block';
	}
		
}


function sendSearchRequest() {
	
	var site = getRawObject('siteToSearch').value;
	var method = getRawObject('selectSearchMethod').value;
	
	switch (method) {
				
		case 'selectLinks':
			pattern = 'findLinks';
			break;
		case 'selectPictures':
			pattern = 'findImages';
			break;
		case 'selectCustom':
			if (getRawObject('searchPattern').value == '') {
				getRawObject('responseDiv').innerHTML = 'Введите шаблон для поиска';
			} else {
				pattern = getRawObject('searchPattern').value;
			}
			break;
	}
		
	xmlhttp_responseDiv = new XMLHttpRequest();
	xmlhttp_responseDiv.onreadystatechange = function() {
		if (xmlhttp_responseDiv.readyState == 4 && xmlhttp_responseDiv.status == 200){
			getRawObject('responseDiv').innerHTML = xmlhttp_responseDiv.responseText;
		}
	}
	xmlhttp_responseDiv.open("POST",'search.php',true);
	xmlhttp_responseDiv.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	var request = 'siteToSearch='+site+'&searchPattern='+pattern;
	xmlhttp_responseDiv.send(request);
}


function loadAllData() {
	xmlhttp_loadAll = new XMLHttpRequest();
	xmlhttp_loadAll.onreadystatechange = function() {
		if (xmlhttp_loadAll.readyState == 4 && xmlhttp_loadAll.status == 200){
			getRawObject('selectAll').innerHTML = xmlhttp_loadAll.responseText;
		}	
	}
	xmlhttp_loadAll.open("GET", "selectAll.php", true);
	xmlhttp_loadAll.send();
}