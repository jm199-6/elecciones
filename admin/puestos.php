<script type="text/javascript">
	chTitle("Admin del Sistema - Puestos");
</script>

	<div class="col-sm-10 col-md-10 col-lg-10 ">
		<center><h4>Listado de Puestos</h4></center>

		<div class="tooltip-demo">
	  	<button type="button" class="btn btn-success btn-circle btn-lg" style="float: right;" data-target="#ModalPuesto" data-toggle="modal" data-placement="right" title="Agregar Puesto"><i class="fa fa-plus"></i></button>
	  </div>

	  <div class="modal fade" id="ModalPuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	      <div class="modal-dialog">
	          <div class="modal-content">
	          	<form method="post">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title" id="myModalLabel">Puesto a seleccionar</h4>
	                </div>
	                <div class="modal-body">
	                	<!-- CAMPOS DEL FORMULARIO-->
	                    <div id="nPuesto" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														Puesto
													</font>
												</span>
												<!--input class='form-control' id="cl" type="hidden" name="pag" value="partidos.php" /-->
												<input class='form-control' id="nombre_puesto" maxlength="250" type="text" name="nombre_puesto" placeholder="Nombre del puesto" title="" />
											</div>
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
									<!--th>Accion</th-->
								</tr>
							</thead>
							<tbody>
							<?php
										$sql = "SELECT id_puesto, nombre_puesto FROM puesto ";

										$result = $conn->query($sql);

										if($result->num_rows > 0){


											while($row=$result->fetch_assoc()){
												$id_puesto=$row['id_puesto'];
												$nombre_puesto=$row['nombre_puesto'];

												echo "<tr>";
												echo "<td>$id_puesto</td>
												<td>$nombre_puesto</td>";

													//echo "<td><a href='?a=".encript("usuarios.php")."&estado=I&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";

												echo "</tr>";
											}

										}else{
											/*echo "<td colspan='2'><div id='notificacion' style='display: block;' class='alert alert-warning alert-dismissable'>
															<font style='vertical-align: inherit;'>
																<font style='vertical-align: inherit;'>
																	No se han encontrado resultados.
															</font>
														</font>
												</div></td>";*/
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
	if(isset($_POST['nombre_puesto'])){
		$nombre_puesto = $_POST['nombre_puesto'];
				//datos para tratar con la base de datos

		$tabla="puesto";
		$campos="nombre_puesto";
		$values="'$nombre_puesto'";

		$sqlI="INSERT INTO $tabla ($campos) VALUES ($values) ";

		if ($conn->query($sqlI) == TRUE) {

				echo "<script>alert('Registro agregado satisfactoriamente.');
				document.location='?a=".encript("puestos.php")."';
				</script>";
		}else{
				echo "
				<script>
				alert('Error: $sql <br> $conn->error .');
					document.location='?pag=puestos.php';
				</script>
				";
		}
	}
?>
