
<div class="panel panel-default">
    <div class="panel-heading">

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills" >
            <li class="active"><a href="#tab_users" data-toggle="tab">Usuarios</a>
            </li>
            <li><a href="#tab_candidatos" data-toggle="tab">Candidatos</a>
            </li>

        </ul>
<br><br>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_users">
                <center><h4>Usuarios Registrados</h4></center>
                <div id="wrapper">
                        <div id="page-wrapper" style="margin-left: 0px;">
                			<div class="panel panel-primary">
                		      <div class="panel-body">
                <table class="table table-bordered table-primary table-responsive" id="dynamic_field" >
                	<thead>
                	<tr>
                		<th>DUI</th>
                		<th>Nombres</th>
                		<th>Apellidos</th>
                		<th>Direccion</th>
                		<th>Privilegio</th>
                		<th>Estado</th>
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
                	    			$apellidos=$row['apellidos'];
                	    			$direccion=$row['direccion'];
                	    			$privilegio = $row['nombre_priv'];
                	    			$estado=$row['estado'];
                	    			echo "<tr>";
                	    			echo "
                	    			<td>$dui</td>
                					<td>$nombres</td>
                					<td>$apellidos</td>
                					<td>$direccion</td>
                					<td>$privilegio</td>";

                					if($estado=="A"){
                						echo "<td>
                								<div class='tooltip-demo'>
                								    <label class='text text-success' data-toggle='tooltip' data-placement='right' title='' data-original-title='Puede Votar'>
                								    	<font style='vertical-align: inherit;'>
                								    		<font style='vertical-align: inherit;'>
                								    		<strong><span class='fa fa-check-circle'></span></strong>
                								    		</font>
                							    		</font>
                								    </label>
                								</div>
                							</td>";
                						echo "<td><a href='?a=".encript("usuarios.php")."&estado=I&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";
                					}else if($estado=="I"){
                						echo "<td>
                								<div class='tooltip-demo'>
                								    <label class='text text-danger' data-toggle='tooltip' data-placement='right' title='' data-original-title='No Puede Votar'>
                								    	<font style='vertical-align: inherit;'>
                								    		<font style='vertical-align: inherit;'>
                								    		<strong><span class='fa fa-times-circle'></span></strong>
                								    		</font>
                							    		</font>
                								    </label>
                								</div>
                							</td>";
                						echo "<td><a href='?a=".encript("usuarios.php")."&estado=A&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";
                					}

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

                </div>
                </div>
              </div>
            </div>
            </div>
            <div class="tab-pane fade" id="tab_candidatos">
                <center><h4>Candidatos Registrados</h4></center>
                <?php
                	include('verCandidatos.php');
                ?>
            </div>

        </div>
    </div>
    <!-- /.panel-body -->
</div>

<!-- finaliza tabla -->
<script>
$(document).ready(function() {
    $('#dynamic_field').DataTable({
        responsive: true
    });
    $('#dynamic_field1').DataTable({
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
<?php
	if(isset($_GET['estado'])){
		$estado = $_GET['estado'];
		$dui_u = $_GET['idUsuario'];

		//dui,nombres,apellidos,id_partido,foto
		$sql = "update cuenta set estado='".$estado."' where idUsuario='".$dui_u."';";

		if($conn->query($sql) == true){
			echo "<script type='text/javascript'>
			window.location = '?a=".encript("usuarios.php")."';
			</script>";
		}
	}
  //show_source("index.php");
?>
