<?php
	date_default_timezone_set ( "America/El_Salvador" );
	if(!file_exists("../comunes/cn.php")) {
		echo "
				<script>
					window.location='install/';
				</script>
			";
		}else{
	session_start();
	if(!(isset($_SESSION["inicio"]))){
		echo "
			<script>
					location.href='../index.php';
			</script>

		";

	}else{
	include("../comunes/cn.php");
	$carpeta=basename(dirname(__FILE__));


	?>


<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset="UTF-8">
<?php include("../comunes/referencias.php");
	require_once "../comunes/encript.php";
?>
	<script type="text/javascript">
		var candidatos = new Array();
		$(document).ready(function(){
			//código a ejecutar cuando el DOM está listo para recibir instrucciones.
			$("#editar").click(function(){
				$("#dui").removeAttr("disabled");
				$("#dui").attr("readonly");
				$("#nombres").removeAttr("disabled");
				$("#apellidos").removeAttr("disabled");
				$("#direccion").removeAttr("disabled");
				$("#pass").removeAttr("disabled");
				$("#nombres").focus();
				$("#nombres").select();
				$("#guardar").show();
			});

			$(".my-select").chosen({
			width:"100%",
			});
			$("#dui_u").keyup(function(){
				var valor = $("#dui_u").val();
				if($("#dui_u").val().length == 8 ){
					$("#dui_u").val(valor+"-");
				}
			});
			$("#ver").click(function(){
				if($("#ver").prop("checked") == true){
					$("#pass").prop("type","text");
				}else{
					$("#pass").prop("type","password");
				}
			});
			$('.tooltip-demo').tooltip({
			    selector: "[data-toggle=tooltip]",
			    container: "body"
			})
			// popover demo
			$("[data-toggle=popover]")
			    .popover();

		    //Para el cambio de contraseña
				$("#rPass1").keyup(function(){
					var pass = $("#pass1").val();
					var rPass = $("#rPass1").val();
					if(pass=="" || rPass==""){
						$("#texto1").text("Las Contraseñas no coinciden");
						$("#icPasswords1").removeClass("fa-check-circle");
						$("#icPasswords1").addClass("fa-times-circle");
						$("#passwords1").removeClass("alert-success");
						$("#passwords1").addClass("alert-danger");
					}else{
						if(pass == rPass ){
							$("#texto1").text("Las Contraseñas coinciden");
							$("#icPasswords1").removeClass("fa-times-circle");
							$("#icPasswords1").addClass("fa-check-circle");
							$("#passwords1").removeClass("alert-danger");
							$("#passwords1").addClass("alert-success");
						}else{
							$("#texto1").text("Las Contraseñas no coinciden");
							$("#icPasswords1").removeClass("fa-check-circle");
							$("#icPasswords1").addClass("fa-times-circle");
							$("#passwords1").removeClass("alert-success");
							$("#passwords1").addClass("alert-danger");
						}
					}
					$("#passwords1").show();
				});
				$("#pass1").keyup(function(){
					var pass = $("#pass1").val();
					var rPass = $("#rPass1").val();
					if(pass=="" || rPass==""){
						$("#texto1").text("Las Contraseñas no coinciden");
						$("#icPasswords1").removeClass("fa-check-circle");
						$("#icPasswords1").addClass("fa-times-circle");
						$("#passwords1").removeClass("alert-success");
						$("#passwords1").addClass("alert-danger");
					}else{
						if(pass == rPass ){
							$("#texto1").text("Las Contraseñas coinciden");
							$("#icPasswords1").removeClass("fa-times-circle");
							$("#icPasswords1").addClass("fa-check-circle");
							$("#passwords1").removeClass("alert-danger");
							$("#passwords1").addClass("alert-success");
						}else if (pass.length<6 || rPass.length<6 ){
							$("#texto1").text("Las Contraseñas no coinciden");
							$("#icPasswords1").removeClass("fa-check-circle");
							$("#icPasswords1").addClass("fa-times-circle");
							$("#passwords1").removeClass("alert-success");
							$("#passwords1").addClass("alert-danger");
						}
					}
					$("#passwords1").show();

				});
				$("#dui1").keyup(function(){
					var valor = $("#dui1").val();
					if($("#dui1").val().length == 8 ){
						$("#dui1").val(valor+"-");
					}
				});
				$("#ver1").click(function(){
					if($("#pass1").attr("type") == "password"){
						$("#pass1").prop("type","text");
						$("#icVer1").removeClass("fa-eye");
						$("#icVer1").addClass("fa-eye-slash");
					}else{
						$("#pass1").prop("type","password");
						$("#icVer1").removeClass("fa-eye-slash");
						$("#icVer1").addClass("fa-eye");
					}
				});
				$("#rVer1").click(function(){
					if($("#rPass1").attr("type") == "password"){
						$("#rPass1").prop("type","text");
						$("#icRVer1").removeClass("fa-eye");
						$("#icRVer1").addClass("fa-eye-slash");
					}else{
						$("#rPass1").prop("type","password");
						$("#icRVer1").removeClass("fa-eye-slash");
						$("#icRVer1").addClass("fa-eye");
					}
				});

		});
		function desmarcar(candidatos) {
			cant=candidatos.length;
			for (var i = 0; i < cant; i++) {
            $("#rb"+candidatos[i]).checked=false;
				$("#"+candidatos[i]).hide();
			}
		}
		function voto(id){
			desmarcar(candidatos);
			$("#"+id).show();
		}
	</script>
</head>
<body>


<div class='container' style="margin-top: 100px;">
<?php
	include("menu.php");
	include("../comunes/cambiarContra.php");
?>


	<?php

	if($_SESSION["type"]=="candidato"){
		$verfContra = "SELECT chPass from cuenta where idUsuario='".$_SESSION["ID"]."'";
		$resContra = $conn->query($verfContra);
		if ($resContra->num_rows > 0) {
			$row = $resContra->fetch_assoc();

				if($row['chPass']==1){

					?>
					<script type="text/javascript">

						$("#modalPass").modal("show");
					</script>
					<?php
				}
		}
	}


		if(isset($_GET["a"])){
			if (file_exists(desencript($_GET["a"]))){
				include(desencript($_GET["a"]));
			}else{
				echo "<script>location='?a=".encript("../comunes/notfound.php")."&ps=".$_GET["a"]."'</script>";
			}
		}else{
			$hora = date("H");
			$min = date("m");
			$seg = date("s");
			if ((($hora.":".$min.":".$seg)>"00:00:00") && (($hora.":".$min.":".$seg)<="12:59:59")){

			}elseif ((($hora.":".$min.":".$seg)>"12:00:00") && (($hora.":".$min.":".$seg)<="18:59:59")) {

			}elseif ((($hora.":".$min.":".$seg)>="18:00:00") && (($hora.":".$min.":".$seg)<"23:59:59")){

			}
			?>
	<div class="row">
		<div class="col-sm-3 col-md-3 col-lg-3">
			&nbsp;
		</div>

		<div class="col-sm-6 col-md-6 col-lg-6">
			<center><h4><?php
				if(isset($_GET['a1']) && desencript($_GET['a1'])=="../comunes/consulta.php"){
					echo "Consulta de Votos";
				}else{
					echo "Votar en linea";
				}

			?></h4></center>
			<br><br><br>
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3" style="z-index: 0;">
			&nbsp;
			<div id="notificacion" style="display: none; z-index: 1; float: left; position: absolute;" class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                	<font style="vertical-align: inherit;">
                		<font style="vertical-align: inherit;">×</font>
                	</font>
                </button>
                	<font style="vertical-align: inherit;">
                    	<label style="vertical-align: inherit; float:left;" id="textoN">Texto notificacion</label>
                	</font>
        	</div>
		</div>
	</div>
	<div class="row">

			<div class='col-sm-6 col-lg-3'>
				<ul class="nav nav-pills nav-stacked nav-fixed">
					<li class="active"><a href='./' style='display:block;'>Votar</a></li>
					<li><a href='?a1=<?php echo encript("../comunes/consulta.php"); ?>' style='display:block;'>Consulta Votaciones</a></li>
				</ul>

			</div>
</div>
<div class="row">
	<div class=' col-lg-3'>
		&nbsp;

	</div>
				<?php
				//$sqlEstado = "select estado from usuario";

				if(isset($_GET["a1"])){
					if(file_exists(desencript($_GET["a1"]))){
						include(desencript($_GET["a1"]));
					}else{
						echo "<script>location='?a1=../comunes/notfound.php&ps=".$_GET["a1"]."'</script>";
					}

				}else{
					?>
					<div class='col-sm-9 col-md-9 col-lg-9'>
				<form method="get">
					<div class="row">
						<?php
					$sqlEstado = "SELECT estado from cuenta where idUsuario='".$_SESSION['ID']."'";
					$resEstado = $conn->query($sqlEstado);
					$i = 0;

					if($resEstado->num_rows > 0){
						$rowEstado = $resEstado->fetch_assoc();
						$cellEstado = $rowEstado['estado'];

						if($cellEstado=="A"){
							$sql = "SELECT c.dui, c.nombres, c.apellidos, c.foto, p.nombre_partido, p.logo_partido, (select count(dui) from candidato) as 'cantCand' FROM candidato c inner join partido p on c.id_partido=p.id_partido";

					    	$result = $conn->query($sql);

					    	if($result->num_rows > 0){

					    		switch($result->num_rows){
				                	case 1:
				                		echo '<div class="span4">&nbsp;</div>';
				                		break;
				                	case 2:
				                		echo '<div class="span3">&nbsp;</div>';
				                		break;
				                	case 3:
				                		echo '<div class="span2">&nbsp;</div>';
				                		break;
				                	case 4:
				                		echo '<div class="span1">&nbsp;</div>';
				                		break;

				                	default:
				                		echo '';
				                		break;
				                }
					    		while($row=$result->fetch_assoc()){
					    			$dui=$row['dui'];
					    			$nombres=$row['nombres'];
					    			$apellidos=$row['apellidos'];
					    			$foto=$row['foto'];
					    			$nombre_partido = $row['nombre_partido'];
					    			$logo_partido=$row['logo_partido'];
					    			$cantCand=$row['cantCand'];

					    			?>
				                    	<div class="span2" >
										<section class="lazy-load-box  effect-slidefromright" data-delay="200" data-speed="800" style="-webkit-transition: all 800ms ease; -moz-transition: all 800ms ease; -ms-transition: all 800ms ease; -o-transition: all 800ms ease; transition: all 800ms ease;">
											<div class="service-box style_1 " >
												<img src="../<?php echo $logo_partido; ?>" width="135px" height="130px" style="opacity: 0.65;position: absolute; z-index:0;left:5px; border-radius: 10px 10px 10px 10px;">
												<div style="opacity: 1;position: absolute; z-index:1; left:25px;">
													<script type="text/javascript">
														candidatos[<?php echo $i; ?>] = "<?php echo $dui; ?>";
													</script>
														<figure class="icon" >
															<a href="#"><label for="rb<?php echo $dui; ?>" onclick="voto('<?php echo $dui; ?>');"><img src="../<?php echo $foto; ?>" style="width: 80px; height: 80px;" alt=""><input type="radio" id="rb<?php echo $dui; ?>" name="duiCandidato" value="<?php echo $dui; ?>" style="display: none;" /></label></a>

														</figure>
														<div class="service-box_body">
															<h4><?php echo $nombres.'<br>'.$apellidos; ?></h4>

														</div>
												</div>
												<img id="<?php echo $dui; ?>" src="../comunes/img/voto.png"  width="135px" height="130px" style="opacity: 1;position: absolute; z-index:2; left:10px; display: none;" />

											</div>

										</section>

										<br><br>
										<br>
										<br>
										<br><br>
										</div>

						<?php
								$i++;
								}
								?>
				   	</div>
		    		<div class="row">
		    			<div class="col-lg-9 col-md-9 col-sm-9">
		    				<br><br>
		    				<input type="submit" class="btn btn-primary" style="float: right;" name="continue" value="Continuar" />
		    			</div>
		    		</div>

						</form>
					</div>
					<?php
							}else{
								?>
				    			<div class="col-lg-9 col-md-9 col-sm-9">

										<div id='alerta' style='display: block;' class='alert alert-info'>
						                <font style='vertical-align: inherit;'>
						                	<font style='vertical-align: inherit;'>
						                		No se han encontrado resultados.
						            		</font>
						            	</font>
						        	</div>

				    			</div>
								<?php
							}
						}else{
							echo "<script>window.location='./?a1=".encript("../comunes/consulta.php")."'</script>";
						}
					}


		    	}


		    ?>

	</div>
</div>
			<?php
				}
				//Codigo para tratamiento de cambio de contraseña y votar

				if (isset($_POST['savePass'])) {
				$dui_u1 = encript($_POST['dui_u1']);
				$pass1 = encript($_POST['p1']);



				$cons= "SELECT * FROM cuenta WHERE idUsuario='".$dui_u1."'";

				$resCand=$conn->query($cons);

				if($resCand->num_rows > 0){

					$sql = "UPDATE cuenta set pass='".$pass1."', chPass='0' WHERE idUsuario='".$dui_u1."'";

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
			}elseif (isset($_GET['duiCandidato'])) {


				$duiCandidato=$_GET['duiCandidato'];
				$duiVotante=$_SESSION['ID'];

				$sql="INSERT INTO voto_candidato (dui_candidato,dui_usuario,fecha_votacion) VALUES ('".$duiCandidato."','".$duiVotante."','".date("d/m/Y")."');";

				if($conn->query($sql)==TRUE){
						echo "<script>window.location='./?a1=".encript("../comunes/consulta.php").
						"'</script>";
				}else{
					echo $conn->error;
				}
			}
			?>

</body>
</html>
<?php }
 }

 ?>
