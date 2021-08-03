<?php

	session_cache_limiter(FALSE);

	session_start();

	if(!file_exists("./comunes/cn.php")) {

		echo "

				<script>

					window.location='install/';

				</script>

			";

		}else{



?>

<html>

	<head>

		<?php include("referencias.php");

			require_once "comunes/encript.php";

		?>

	</head>

	<body style="margin-top: 100px;">

		<div class="container">

		   <div class="row">

		      <div class="col-sm-4 col-md-4 col-lg-4">

		        &nbsp;

		      </div>

		      <div class="col-sm-4 col-md-4 col-lg-4">

		        <div class="panel panel-primary">

		        	<div class="panel-heading">Iniciar Sesion</div>

		        	<div class="panel-body">

						<form method='post'>



							<div id="nUsuario" class="form-group input-group">

								<span class="input-group-addon">

									<font style="vertical-align:inherit;">

										<i style="vertical-align:inherit;"  class='fa fa-user'></i>

									</font>

								</span>

								<input class='form-control' id="log" maxlength="10" type="text" name="login" placeholder="DUI" pattern="[0-9\-]{10,10}" title="Letras y números. Tamaño mínimo: 10. Tamaño máximo: 10" />

							</div>



							<div id="cUsuario" class="form-group input-group">

								<span class="input-group-addon">

									<font style="vertical-align:inherit;">

										<i style="vertical-align:inherit;" class='fa fa-unlock-alt'></i>

									</font>

								</span>

								<input class='form-control' id="cl" type="password" name="cl" placeholder="Contraseña" />

							</div>



								<center>

									<input class="btn btn-outline btn-primary btn-lg btn-block" type="submit" name='entrar' value='Iniciar Sesión' />





								</center>



						</form>

						<div class="tooltip-demo" >

							<button type="button" class="btn btn-outline btn-link" data-target="#modalPass" data-toggle="modal" data-placement="right" title="Olvide mi contraseña">

							    	<font style="vertical-align: inherit;">

							   			<font style="vertical-align: inherit;">Olvidé mi contraseña</font>

							   		</font>

						    	</button>

					    </div>

					    <?php



					    	include("./comunes/cambiarContra.php");

				    	?>

						<div class="tooltip-demo">

							<center>

					    	<button type="button" class="btn btn-outline btn-success" data-target="#myModal" data-toggle="modal" data-placement="right" title="Registrarse">

					    		<font style="vertical-align: inherit;">

					    			<font style="vertical-align: inherit;"><i class="fa fa-plus"></i>Registrate</font>

					    		</font>

					    	</button>

					    	</center>

					    </div>

				   		<?php



					    	include("./comunes/registrarse.php");

				    	?>

						<!--Notificacion-->

						<br>

						<div id="notificacion" style="display: none;" class="alert alert-dismissable">

	                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">

	                        	<font style="vertical-align: inherit;">

	                        		<font style="vertical-align: inherit;">×</font>

	                        	</font>

	                        </button>

	                        	<font style="vertical-align: inherit;">

		                        	<label style="vertical-align: inherit; float:'left'" id="textoN"></label>

		                    	</font>

	                	</div>



		        	</div>

		        </div>

		      </div>

		   </div>

		</div>



		<?php

		include("./comunes/cn.php");



			if (isset($_POST['login'])) {

				$login=encript($_POST['login']);

				$cl=encript($_POST['cl']);

				$tabla="";





				$sql="SELECT * from cuenta where idUsuario='$login' and pass='$cl'";

				$result=$conn->query($sql);



				if ($result->num_rows > 0) {

					$row = $result->fetch_assoc();



						$_SESSION["inicio"]="ok";



						$ruta="";



						if($row['idPriv']==1){

							$tabla="usuario";

							$_SESSION['type']="admin";

							$ruta = "./admin/";

						}elseif($row['idPriv']==2){

							$tabla="usuario";

							$_SESSION['type']="usuario";

							$ruta = "./user/";

						}elseif($row['idPriv']==3){

							$tabla="candidato";

							$_SESSION['type']="candidato";

							$ruta = "./user/";

						}



						$sqlUsuario = "SELECT * FROM ".$tabla." where dui='".$login."'";

						$resultUsuario=$conn->query($sqlUsuario);

						if ($resultUsuario->num_rows > 0) {

							$row1 = $resultUsuario->fetch_assoc();



							$_SESSION["nombre"]=$row1['nombres']." ".$row1['apellidos'];

							$_SESSION["ID"]=$row1['dui'];

						}

						echo "

						<script>

							location.href='".$ruta."';

						</script>";



				}else{



					echo "

					<script type='text/javascript'>

						$('#nUsuario').addClass('has-error');

						$('#cUsuario').addClass('has-error');

						$('#notificacion').removeClass('alert-success');

						$('#notificacion').addClass('alert-danger');

						$('#icNoti').removeClass('fa-check-circle');

						$('#icNoti').addClass('fa-times-circle');

						$('#textoN').text('El DUI o contraseña no coinciden.');

						$('#notificacion').show();

					</script>";

				}



			}elseif (isset($_POST['save'])) {

				$dui_u = encript($_POST['dui_u']);

				$nombres = $_POST['nombres'];

				$apellidos = $_POST['apellidos'];

				$direccion = $_POST['direccion'];

				$p = encript($_POST['p']);

				$id_priv = $_POST['id_priv'];





				$sqlCuenta="INSERT INTO cuenta (idUsuario,p,idPriv,chp,estado) VALUES ('".$dui_u."','".$p."','".$id_priv."','0','A')";

				$sqlUsuario = "INSERT INTO usuario (dui,idUsuario,nombres,apellidos,direccion) VALUES ('".$dui_u."', '".$dui_u."', '".$nombres."' ,'".$apellidos."','".$direccion."')";



				$cons_cuenta= "SELECT * FROM cuenta WHERE idUsuario='".$dui_u."'";



				$resCuenta=$conn->query($cons_cuenta);



				if($resCuenta->num_rows > 0){

					echo "<script>

					$('#notificacion').removeClass('alert-success');

					$('#notificacion').addClass('alert-danger');

					$('#icNoti').removeClass('fa-check-circle');

					$('#icNoti').addClass('fa-times-circle');

					$('#textoN').text('Lo sentimos, no se ha podido registrar. Este usuario ya existe.');

					$('#notificacion').show();

					</script>";

				}else{

						if($conn->query($sqlCuenta) == TRUE){

							if($conn->query($sqlUsuario) == TRUE){

								echo "<script>

								$('#notificacion').removeClass('alert-danger');

								$('#notificacion').addClass('alert-success');

								$('#icNoti').removeClass('fa-times-circle');

								$('#icNoti').addClass('fa-check-circle');

								$('#textoN').text('Te has Registrado Exitosamente.');

								$('#notificacion').show();

								</script>";

							}else{

								echo "<script>

								$('#notificacion').removeClass('alert-success');

								$('#notificacion').addClass('alert-danger');

								$('#icNoti').removeClass('fa-check-circle');

								$('#icNoti').addClass('fa-times-circle');

								$('#textoN').text(".$conn->error.".);

								$('#notificacion').show();

								</script>";

							}



						}

				}

			}elseif (isset($_POST['savePass'])) {

				$dui_u1 = encript($_POST['dui_u1']);

				$p1 = encript($_POST['p1']);







				$cons_cuenta= "SELECT * FROM cuenta WHERE idUsuario='".$dui_u1."'";



				$resCuenta=$conn->query($cons_cuenta);



				if($resCuenta->num_rows > 0){



					$sql = "UPDATE cuenta set p='".$p1."' WHERE idUsuario='".$dui_u1."'";



					if ($conn->query($sql) == TRUE) {

						echo "<script>

							$('#notificacion').removeClass('alert-danger');

							$('#notificacion').addClass('alert-success');

							$('#icNoti').removeClass('fa-times-circle');

							$('#icNoti').addClass('fa-check-circle');

							$('#textoN').text('La contraseña se ha cambiado exitosamente.');

							$('#notificacion').show();

							</script>";

					}else{

						echo "<script>

							$('#notificacion').removeClass('alert-success');

							$('#notificacion').addClass('alert-danger');

							$('#icNoti').removeClass('fa-check-circle');

							$('#icNoti').addClass('fa-times-circle');

							$('#textoN').text('Lo sentimos, no se ha podido cambiar la contraseña. Intenta nuevamente.');

							$('#notificacion').show();

							</script>";

					}



				}

			}
			//include("indexa.php");

		?>



	</body>

</html>

<?php } ?>

