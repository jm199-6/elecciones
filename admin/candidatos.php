<div class="col-sm-10 col-md-10 col-lg-10 ">
	<center><h4>Candidatos</h4></center>

	<div class="tooltip-demo">
    	<button type="button" class="btn btn-success btn-circle btn-lg" style="float: right;" data-target="#myModal" data-toggle="modal" data-placement="right" title="Agregar un Partido"><i class="fa fa-plus"></i></button>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            	<form method="post" enctype='multipart/form-data'>
						                <div class="modal-header">
						                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                    <h4 class="modal-title" id="myModalLabel">Candidatos</h4>
						                </div>
						                <div class="modal-body">
						                	<!-- CAMPOS DEL FORMULARIO-->
						                    <div id="nUsuario" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														<i class="fa fa-user"></i>
													</font>
												</span>
												<input required class='form-control' id="dui_u" maxlength="10" type="text" name="dui" placeholder="Numero de DUI" pattern="[0-9\-]{10,10}" title="Tamaño mínimo: 10. Tamaño máximo: 10" />
											</div>

											<div id="nombresC" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														NOMBRES
													</font>
												</span>
												<input required class='form-control' id="nombres" onKeyUp="this.value=this.value.toUpperCase();" maxlength="150" type="text" name="nombres" placeholder="Nombres" pattern="[a-zA-Z0-9\-\ ]{1,150}" title="Tamaño mínimo: 1. Tamaño máximo: 150" />
											</div>

											<div id="apellidosC" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														APELLIDOS
													</font>
												</span>
												<input required class='form-control' id="apellidos" onKeyUp="this.value=this.value.toUpperCase();" maxlength="150" type="text" name="apellidos" placeholder="Apellidos" pattern="[a-zA-Z0-9\-\ ]{1,150}" title="Tamaño mínimo: 1. Tamaño máximo: 150" />
											</div>

											<div id="apellidosC" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														PARTIDO
													</font>
												</span>
												<select name="id_partido" class="form-control my-select">
													<option value="0">Selecciona un Partido</option>
													<?php
														$sqlP = "SELECT * FROM partido";

														$resultP = $conn -> query($sqlP);
														if($resultP->num_rows > 0){
															while ($row = $resultP->fetch_assoc()) {
																$id_partido = $row['id_partido'];
																$nombre_partido = $row['nombre_partido'];
																$logo_partido = $row['logo_partido'];

																echo "<option value='".$id_partido."' data-img-src='../".$logo_partido."'><label>".$nombre_partido." </label></option>";
															}
														}
													?>
												</select>
											</div>

											<div id="apellidosC" class="form-group input-group">
												<span class="input-group-addon">
													<font style="vertical-align:inherit;">
														<i class="fa fa-photo-video"></i>
													</font>
												</span>
												<input required class='form-control' id="foto" maxlength="150" type="file" name="foto" placeholder="Apellidos" pattern="[a-zA-Z0-9\-\ ]{1,150}" title="Tamaño mínimo: 1. Tamaño máximo: 150" />
											</div>

											<div id="imagesUploadContent">
												<output id='result'>
											</div>
											<!--FIN CAMPOS DEL FORMULARIO -->
											<script>
												function handleFileSelect() {
										              //Check File API support
										              $("#box-image-library").remove();
										              if (window.File && window.FileList && window.FileReader) {

										                  var files = event.target.files; //FileList object
										                  var output = document.getElementById("result");

										                  for (var i = 0; i < files.length; i++) {

										                      var file = files[i];
										                      //Only pics
										                      if (!file.type.match('image')) continue;

										                      var picReader = new FileReader();

										                      picReader.addEventListener("load", function (event) {


										                          var picFile = event.target;

										                          var imageBox = $("<div class='box-image-library' id='box-image-library'> \
										                                               <img class='image-library' id='fileImageLibrary' width='100px' height='100px'/> \
										                                                    <div class='box-text-image-library-upload'> \
										                                                   <span class='text-descripcio-image-library' id='text-descripcio-image-library'></span> \
										                                               </div> \
										                                           </div>");

										                          // Insert Element in Box Content
										                          $('#imagesUploadContent').append(imageBox);

										                          // Set src img, filename and modify id elements
										                          $('#fileImageLibrary').attr('src', picFile.result);
										                          $('#text-descripcio-image-library').text(file.name);

										                          $('#fileImageLibrary').attr('id','fileImageLibrary-' + file.name );
										                          $('#text-descripcio-image-library').attr('id','text-descripcio-image-library-' + file.name );
										                      });

										                      //Read the image
										                      picReader.readAsDataURL(file);
										                  }
									              	} else {
									                  	console.log("Your browser does not support File API");
								        	      	}
									          	}

										        document.getElementById('foto').addEventListener('change', handleFileSelect, false);
											</script>
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						                    <button type="submit" name="save" value="ok" class="btn btn-primary">Guardar Cambios</button>
						                </div>
					                </form>
            </div>

            <!-- /.modal-content -->
        </div>

    </div>

</div>
</div>
<div class="row">

		<?php

	    	$sql = "SELECT c.dui, c.nombres, c.apellidos, c.foto, p.nombre_partido, p.logo_partido FROM candidato c inner join partido p on c.id_partido=p.id_partido";

	    	$result = $conn->query($sql);

	    	if($result->num_rows > 0){

	    		switch($result->num_rows){
                	case 1:
                		echo '<div class="span5">&nbsp;</div>';
                		break;
                	case 2:
                		echo '<div class="span4">&nbsp;</div>';
                		break;
                	case 3:
                		echo '<div class="span3">&nbsp;</div>';
                		break;
                	case 4:
                		echo '<div class="span2">&nbsp;</div>';
                		break;
                	case 5:
                		echo '<div class="span1">&nbsp;</div>';
                		break;
                	default:
                		echo '';
                		break;
                }
	    		while($row=$result->fetch_assoc()){
	    			$dui=encript($row['dui']);
	    			$nombres=$row['nombres'];
	    			$apellidos=$row['apellidos'];
	    			$foto=$row['foto'];
	    			$nombre_partido = $row['nombre_partido'];
	    			$logo_partido=$row['logo_partido'];
	    			?>
                    	<div class="span2" >
						<section class="lazy-load-box  effect-slidefromright" data-delay="200" data-speed="800" style="-webkit-transition: all 800ms ease; -moz-transition: all 800ms ease; -ms-transition: all 800ms ease; -o-transition: all 800ms ease; transition: all 800ms ease;">
							<div class="service-box style_1 " >
								<img src="../<?php echo $logo_partido; ?>" width="135px" height="130px" style="opacity: 0.65;position: absolute; z-index:0;left:5px; border-radius: 10px 10px 10px 10px;">
								<div style="opacity: 1;position: absolute; z-index:1; left:25px;">
									<figure class="icon" >
										<a href="#"><img src="../<?php echo $foto; ?>" style="width: 80px; height: 80px;" alt=""></a>
									</figure>
									<div class="service-box_body">
										<h4 class="title"><?php echo $nombres.'<br>'.$apellidos; ?></h4>

									</div>
								</div>
							</div>

						</section>
						</div>
<?php
	    		}
	    	}else{
	    		echo "<div id='alert' style='display: block;' class='alert alert-warning alert-dismissable'>
	                <font style='vertical-align: inherit;'>
	                	<font style='vertical-align: inherit;'>
	                		No se han encontrado resultados.
	            		</font>
	            	</font>
	        	</div>";
	    	}

	    ?>
</div>

<?php
	if(isset($_POST['save'])){
		$dui = $_POST['dui'];
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$id_partido = $_POST['id_partido'];

		//dui,nombres,apellidos,id_partido,foto
		if (isset($_FILES["foto"])) {
			if (is_uploaded_file($_FILES['foto']['tmp_name'])){
				$tmp_name = $_FILES['foto']['tmp_name'];
				$name="comunes/img/fotos/".$_FILES['foto']['name'];
				move_uploaded_file($tmp_name, "../".$name);

				//datos para tratar con la base de datos
				$pass = str_replace("-", "", $dui);
				$tabla="candidato";
				$campos="dui,nombres,apellidos,foto,id_partido";
				$values="'".encript($dui)."','$nombres','$apellidos','$name','$id_partido'";

				$sqlC = "INSERT INTO cuenta (idUsuario,pass,idPriv,chPass,estado) VALUES ('".encript($dui)."','".encript($pass)."','3','1','A') ";

				$sqlI="INSERT INTO $tabla ($campos) VALUES ($values) ";

				if ($conn->query($sqlC) == TRUE) {
					if ($conn->query($sqlI) == TRUE) {
						echo "<script>alert('Registro agregado satisfactoriamente.');
						document.location='?a=".encript("candidatos.php")."';
						</script>";
					}
				}else {
					echo "Error: $sql <br> $conn->error ";
				}
			}else{
				echo "
				<script>
				alert('No se ha podido subir el archivo, no se ha seleccionado alguno.');
					document.location='?a=".encript("candidatos.php")."
					';
				</script>
				";
			}
		}
	}
?>
