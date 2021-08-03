

<div class="col-sm-10 col-md-10 col-lg-10 ">
	<center><h4>Partidos Inscritos</h4></center>

	<div class="tooltip-demo">
    	<button type="button" class="btn btn-success btn-circle btn-lg" style="float: right;" data-target="#myModal" data-toggle="modal" data-placement="right" title="Agregar un Partido"><i class="fa fa-plus"></i></button>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            	<form method="post" enctype='multipart/form-data'>
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title" id="myModalLabel">Partidos Políticos</h4>
	                </div>
	                <div class="modal-body">
	                	<!-- CAMPOS DEL FORMULARIO-->
	                    <div id="nUsuario" class="form-group input-group">
							<span class="input-group-addon">
								<font style="vertical-align:inherit;">
									<i style="vertical-align:inherit;"  class='fa fa-flag'></i>
								</font>
							</span>
							<!--input class='form-control' id="cl" type="hidden" name="pag" value="partidos.php" /-->
							<input class='form-control' id="log" maxlength="250" type="text" name="nombreP" placeholder="Nombre del partido" title="" />
						</div>

						<div id="cUsuario" class="form-group input-group">
							<span class="input-group-addon">
								<font style="vertical-align:inherit;">
									<i style="vertical-align:inherit;" class='fa fa-image'></i>
								</font>
							</span>
							<input class='form-control' id="logoP" type="file" name="logoP" title="Logo del Partido" />

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

										        document.getElementById('logoP').addEventListener('change', handleFileSelect, false);
											</script>
						<!--FIN CAMPOS DEL FORMULARIO -->
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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

	    	$sql = "SELECT id_partido, nombre_partido, logo_partido FROM partido";

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
                		echo '<div class="span3"></div>';
                		break;
                	case 4:
                		echo '<div class="span2"></div>';
                		break;
                	case 5:
                		echo '<div class="span1"></div>';
                		break;
                	default:
                		echo '';
                		break;
                }
	    		while($row=$result->fetch_assoc()){
	    			$id=$row['id_partido'];
	    			$nombre_partido = $row['nombre_partido'];
	    			$logo_partido = $row['logo_partido'];

	    			echo '
                    	<div class="span2" >
						<section class="lazy-load-box  effect-slidefromright" data-delay="200" data-speed="800" style="-webkit-transition: all 800ms ease; -moz-transition: all 800ms ease; -ms-transition: all 800ms ease; -o-transition: all 800ms ease; transition: all 800ms ease;">
							<div class="service-box style_1">
								<figure class="icon">
									<a href="#"><img src="../'.$logo_partido.'" alt="" width="80px" height="80px"></a>
								</figure>
								<div class="service-box_body">
									<h4 class="title">'.$nombre_partido.'</h4>

								</div>
							</div>
						</section>
						</div>
                        ';
	    			/*echo "<div class='col-sm-3 col-md-3 col-lg-3'>
	    				<img class='img img-responsive img-rounded' src='../".$logo_partido."' >
	    				</br>
	    				<label>".$nombre_partido."</label>
	    			</div>";
*/
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
