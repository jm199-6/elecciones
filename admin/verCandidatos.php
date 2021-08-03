
<div id="wrapper">
        <div id="page-wrapper" style="margin-left: 0px;">
			<div class="panel panel-primary">
		      <div class="panel-body">
<table class="table table-bordered table-primary table-responsive" id="dynamic_field1" >
	<thead>
	<tr>
		<th>FOTO</th>
    <th>PARTIDO</th>
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

	    	$sql = "SELECT u.dui, u.nombres, u.apellidos, u.foto, p.nombre_priv, c.estado, c.pass, pa.logo_partido, pa.nombre_partido FROM candidato u inner join cuenta c on u.dui=c.idUsuario inner join privilegio p on c.idPriv=p.id_priv inner join partido pa on pa.id_partido=u.id_partido";

	    	$result = $conn->query($sql);

	    	if($result->num_rows > 0){


	    		while($row=$result->fetch_assoc()){
	    			$dui=desencript($row['dui']);
	    			$nombres=$row['nombres'];
	    			$apellidos=$row['apellidos'];
	    			$privilegio = $row['nombre_priv'];
	    			$estado=$row['estado'];
	    			$foto = $row['foto'];
            $logo_partido = $row['logo_partido'];

	    			echo "<tr>";
	    			echo "
	    			<td><img src='../$foto' style='width:60px; height:60px; border-radius:50%;'></td>
            <td><img src='../$logo_partido' style='width:60px; height:60px; border-radius:50%;'></td>
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
						echo "<td><a href='?a=".encript("usuarios.php")."&estadoC=I&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";
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
						echo "<td><a href='?a=".encript("usuarios.php")."&estadoC=A&idUsuario=".encript("$dui")."'><button class='btn btn-success'>Cambiar Estado</button></a></td>";
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

<?php
	if(isset($_GET['estadoC'])){
		$estado = $_GET['estadoC'];
		$dui_u = $_GET['idUsuario'];

		//dui,nombres,apellidos,id_partido,foto
		$sql = "update cuenta set estado='".$estado."' where idUsuario='".$dui_u."';";

		if($conn->query($sql) == true){
			echo "<script type='text/javascript'>
			window.location = '?a=".encript("usuarios.php")."';
			</script>";
		}
	}
?>
