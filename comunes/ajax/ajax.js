function objetoAjax(){
	var xmlhttp = false;
	try{
		xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp=false
		}

	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp=new XMLHttpRequest();
	}
	return xmlhttp;
}

function  llamar(){
	divResultado = document.getElementById("contenido");
	divResultado.innerHTML='<img src="loading.gif">';
	ajax = objetoAjax();
	ajax.open("POST","formulario.php",true);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status==200){
			divResultado.innerHTML=ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send()
}