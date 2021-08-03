<script type="text/javascript">
	chTitle("Admin del Sistema - Partidos");
</script>

	<div class="col-sm-10 col-md-10 col-lg-10 ">
		<center><h4>Listado de Puestos</h4></center>

		<div class="tooltip-demo">
	  	<button type="button" class="btn btn-success btn-circle btn-lg" style="float: right;" data-target="#ModalPuesto" data-toggle="modal" data-placement="right" title="Agregar Puesto"><i class="fa fa-plus"></i></button>
	  </div>
	
	  <div class="modal fade" id="ModalPuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	      <div class="modal-dialog">
	          <div class="modal-content">
	          	<form method="post" enctype='multipart/form-data'>
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title" id="myModalLabel">Puesto a seleccionar</h4>
	                </div>
	                <div class="modal-body">
	                	<!-- CAMPOS DEL FORMULARIO-->
	                    <div id="nUsuario" class="form-group input-group">
							<span class="input-group-addon">
								<font style="vertical-align:inherit;">
									Puesto
								</font>
							</span>
							<!--input class='form-control' id="cl" type="hidden" name="pag" value="partidos.php" /-->
							<input class='form-control' id="log" maxlength="250" type="text" name="nombreP" placeholder="Nombre del puesto" title="" />
						</div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                    <button type="submit" class="btn btn-primary">Guardar</button>
	                </div>
	              </form>
	          </div>

	          <!-- /.modal-content -->
	      </div>

	  </div>

	</div>
</div>
<div class="row">
	
	<div id="wrapper">
		<div id="page-wrapper" style="margin-left: 0px;">
				<div class="panel panel-primary">
					<div class="panel-body">
						<table class="table table-bordered table-primary table-responsive" id="tablePuesto" >
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Nombre del puesto</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
							<?php
										$sql = "SELECT u.dui, u.nombres, u.apellidos, u.direccion, p.nombre_priv, c.estado, c.pass FROM usuario u inner join cuenta c on u.idUsuario=c.idUsuario inner join privilegio p on c.idPriv=p.id_priv";

										$result = $conn->query($sql);

										if($result->num_rows > 0){


											while($row=$result->fetch_assoc()){
												$dui=desencript($row['dui']);
												$nombres=$row['nombres'];
												
												echo "<tr>";
												echo "<td>$dui</td>
												<td>$nombres</td>";
												
													echo "<td><a href='?a=".encript("usuarios.php")."&estado=I&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";
												
												echo "</tr>";
											}

										}else{
											echo "<div id='notificacion' style='display: block;' class='alert alert-warning alert-dismissable'>
															<font style='vertical-align: inherit;'>
																<font style='vertical-align: inherit;'>
																	No se han encontrado resultados.
															</font>
														</font>
												</div>";
										}

									?>
							 </tbody>
						 </table>
						 <script>
						 $(document).ready(function() {
						     $('#tablePuesto').DataTable({
						         responsive: true
						     });
						     // tooltip demo
						     $('.tooltip-demo').tooltip({
						         selector: "[data-toggle=tooltip]",
						         container: "body"
						     });
						     // popover demo
						     $("[data-toggle=popover]").popover();
						 });
						 </script>
					 </div>
			 	</div>
		</div>
	</div>
</div>
<?php
	if(isset($_POST['nombreP'])){
		$nombreP = $_POST['nombreP'];

		if (isset($_FILES["logoP"])) {
			if (is_uploaded_file($_FILES['logoP']['tmp_name'])){
				$tmp_name = $_FILES['logoP']['tmp_name'];
				$name="comunes/img/logos/".$_FILES['logoP']['name'];
				move_uploaded_file($tmp_name, "../".$name);

				//datos para tratar con la base de datos

				$tabla="partido";
				$campos="nombre_partido,logo_partido";
				$values="'$nombreP','$name'";

				$name = substr($name, 3, (strlen($name)-1));


				$sqlI="INSERT INTO $tabla ($campos) VALUES ($values) ";

				if ($conn->query($sqlI) == TRUE) {

						echo "<script>alert('Registro agregado satisfactoriamente.');
						document.location='?a=".encript("partidos.php")."';
						</script>";
				}else {
					echo "Error: $sql <br> $conn->error ";
				}
			}else{
				echo "
				<script>
				alert('No se ha podido subir el archivo, no se ha seleccionado alguno.');
					document.location='?pag=partidos.php';
				</script>
				";
			}
		}
	}
?>
