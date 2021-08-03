function buscar(){
	var texto=document.getElementById("login");
	if(window.XMLHttpRequest){
		objetoAjax=new XMLHttpRequest();

	}
	objetoAjax.onreadystatechange=function(){
		if(objetoAjax.readyState==4 && objetoAjax.status==200){
			var respuesta=objetoAjax.responseText;			
			var hu=parseInt(respuesta);
			if(hu>1){
				document.getElementById("respuesta").innerHTML ="<font color=red >Usuario ya existe</font>";
			}else{
				if (document.getElementById("login").value=="") {
					document.getElementById("respuesta").innerHTML="";
				}else{
					document.getElementById("respuesta").innerHTML ="<font color=green >Usuario disponible</font>";	
				}

				
			}
		}
	}
	objetoAjax.open("GET","consultaajax.php?login="+texto.value);
	objetoAjax.send();

}

function validarcontra(){
	var clave=document.getElementById("clave").value;
	var rclave=document.getElementById("rclave").value;

	if(clave!=rclave){
		document.getElementById("respuestaRcontra").innerHTML ="<font color=red >Las Contraseñas no coinciden</font>";
	}else{
		if (rclave=="") {
			document.getElementById("respuestaRcontra").innerHTML="";
		}else{
			document.getElementById("respuestaRcontra").innerHTML ="<font color=green >Contraseñas correctas</font>";	
		}
	}
}