<center><h4>Ingrese los datos del Usuario Administrador de su Sistema</h4></center>
<form method='post'>
	<input type='hidden' name='server' value="<?php echo $_GET['server']; ?>">
	<input type='hidden' name='user' value="<?php echo $_GET['user']; ?>">
	<input type='hidden' name='password' value="<?php echo $_GET['password']; ?>">
	<input type='hidden' name='bd' value="<?php echo $_GET['bd']; ?>">
	<input type='hidden' id='id_priv' name='id_priv' class='form form-control' value='1'>
	<label >DUI</label>
	<input type='text' class='form form-control' id='dui' name='dui' maxlength="10">
	<br>
	<label >NOMBRES</label>
	<input type='text' class='form form-control' id='nombres' name='nombres' >
	<br>
	<label >APELLIDOS</label>
	<input type='text' class='form form-control' id='apellidos' name='apellidos' >
	<br>
	<label >DIRECCION</label>
	<input type='text' class='form form-control' id='direccion' name='direccion' >
	<br>
	<label >CONTRASEÑA</label>
	<input type='password' class='form form-control' id='pass' name='pass' >
	<label><input type='checkbox' id='ver'>Ver Contraseña</label>
	<br><br>

	<input type='submit'  id='guardar' name='ok' value='Guardar' class='btn btn-outline btn-primary btn-lg btn-block'>
</form>
<center>
	<ul class="nav nav-pills">
		<li>
			<a href="#" style="display:block;">&nbsp;<span class="badge pull-right">1</span></a>
		</li>
		<li class="active">
			<a href="#" style="display:block;">&nbsp;<span class="badge pull-right">2</span></a>
		</li>
	</ul>
</center>
<script type="text/javascript">
$(document).ready(function(){
	$("#dui").keyup(function(){
		var valor = $("#dui").val();
		if($("#dui").val().length == 8 ){
			$("#dui").val(valor+"-");
		}
	});
	$("#ver").click(function(){
		if($("#ver").prop("checked") == true){
			$("#pass").prop("type","text");
		}else{
			$("#pass").prop("type","password");
		}
	});
});
</script>
<?php
	require_once "../comunes/encript.php";
	if(isset($_POST['ok'])){
		$dui=$_POST['dui'];
		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$direccion=$_POST['direccion'];
		$pass=$_POST['pass'];
		$id_priv=$_POST['id_priv'];

		$server=$_POST['server'];
		$user=$_POST['user'];
		$password=$_POST['password'];
		$bd=$_POST['bd'];

		$conn = new mysqli($server,$user,$password,$bd);

		$sqlCuenta="INSERT INTO cuenta (idUsuario,pass,idPriv,chPass,estado) VALUES ('".encript($dui)."','".encript($pass)."','".$id_priv."','0','A')";

		$sqlUsuario="INSERT into usuario (dui,idUsuario,nombres,apellidos,direccion) values ('".encript($dui)."','".encript($dui)."','".$nombres."','".$apellidos."','".$direccion."');";

		if($conn->query($sqlCuenta)==TRUE){

			if($conn->query($sqlUsuario)==TRUE){

				$fConn=fopen("../comunes/cn.php", "w");
				fwrite($fConn, "<?php \$server = '".$_POST['server']."';".PHP_EOL);
				fwrite($fConn, "\$user = '".$_POST['user']."';".PHP_EOL);
				fwrite($fConn, "\$password = '".$_POST['password']."';".PHP_EOL);
				fwrite($fConn, "\$DB = '".$_POST['bd']."';".PHP_EOL);
				fwrite($fConn, "\$conn = new mysqli(\$server,\$user,\$password,\$DB); ?>".PHP_EOL);
				fclose($fConn);

				echo "<script>window.location='../'</script>";
				
			}
		}else{
			echo $conn->error;
		}


	}
?>
