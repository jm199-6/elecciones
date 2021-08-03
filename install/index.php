<?php if(!file_exists("../comunes/cn.php")) {
	session_start();
	session_destroy();
	?>
<html>
<head>
	<title>Instalaci&oacute;n del Sistema</title>
	<?php
		include("../comunes/referencias.php");
		require_once "../comunes/encript.php";
	?>
</head>
<body>
	<div class='container'>

		<div class='row'>
			<div class='col-md-3'>&nbsp;</div>
			<div class='col-md-6'>
				<?php
					if(isset($_GET['a'])){
						include(desencript($_GET['a']));
					}else{
						?>
						<center><h4>Para continuar debe instalar la Base de Datos en su servidor</h4></center>
						<form method="post" action="crear_bd.php">
							Direccion del Servidor:
								<p class="text-info">Por ejemplo: localhost o xxx.xxx.xxx.xxx</p>
								<input type="text" class="form-control" placeholder="Servidor" name="server" required>
								<br>
							Nombre de la Base de datos:</br>
								<input type="text" class="form-control" placeholder="Base de datos" name="bd" required>
								<br>
							Usuario del Servidor de Bases de Datos:</br>
								<input type="text" class="form-control" placeholder="usuario" name="user" required>
								<br>
							Contrase&ntilde;a:</br>
								<input type="password" class="form-control" placeholder="Contrase&ntilde;a" name="password">
								<br>
							<!--hr>
							<label>Usuario del Administrador del sistema:</br>
								<input type="text" class="campo" placeholder="Usuario Administrador" name="user_sis" required>
							</label><br>
							<label>Contrase&ntilde;a de administrador:</br>
								<input type="password" class="campo" placeholder="Contrase&ntilde;a de Administrador" name="password_sis" required>
							</label><br-->
							<input type="submit" class="btn btn-success" style="float: right;" name="crear" value="Aceptar">
						</form>
						<center>
							<ul class="nav nav-pills">
								<li class="active">
									<a href="#" style="display:block;">&nbsp;<span class="badge pull-right">1</span></a>
								</li>
								<li>
									<a href="#" style="display:block;">&nbsp;<span class="badge pull-right">2</span></a>
								</li>
							</ul>
						</center>

						<?php
					}
				?>


			</div>
			<div class='col-md-3'></div>
		</div>

	</div>

</body>
</html>
<?php
}else{
	echo "<script>window.location='../';</script>";
}
?>
