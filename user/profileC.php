<br><br><br>
<?php
	$sql = "SELECT u.dui, u.nombres, u.apellidos, u.foto, c.pass, p.nombre_priv, p.id_priv from candidato u inner join cuenta c on c.idUsuario=u.dui inner join privilegio p on c.idPriv = p.id_priv where dui = '".$_SESSION["ID"]."'";

	$result=$conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$sqlPriv = "SELECT id_priv, nombre_priv FROM privilegio";

		$resP = $conn->query($sqlPriv);


?>
<div class="col-sm-2 col-md-2 col-lg-2">
	&nbsp;
</div>
<div class="col-sm-8 col-md-8 col-lg-8">
	<center>

	</center>

	<br>
	<div class="panel panel-primary">
		<div class="panel-heading" style="height: 100px;">
			<img src="../<?php echo $row['foto']; ?>" height="80px" width="80px" style="float: left;" alt="">
			<center>
			<h5 style="color: #fff;"><?php echo $row["nombres"]." ".$row["apellidos"]; ?>
				<button id="editar" class="btn btn-outline btn-primary" style="color: #fff; float: right;" title="Editar Perfil">
					<i class="fa fa-edit"  ></i>
				</button>
			</h5>
			</center>
		</div>
		<div class="panel-body" ><!--style=" background-image: url('../<?php //echo $row['foto']; ?>');"-->
			<form method="post">
				<label >DUI</label>
				<input type="text" class="form form-control" id="dui" name="dui" value="<?php echo desencript($row['dui']); ?>" disabled>
				<br>
				<label >NOMBRES</label>
				<input type="text" class="form form-control" id="nombres" name="nombres" value="<?php echo $row['nombres'] ?>" onKeyUp="this.value=this.value.toUpperCase();" disabled>
				<br>
				<label >APELLIDOS</label>
				<input type="text" class="form form-control" id="apellidos" name="apellidos" value="<?php echo $row['apellidos'] ?>" onKeyUp="this.value=this.value.toUpperCase();" disabled>
				<br>

				<label >CONTRASEÑA</label>
				<input type="password" class="form form-control" id="pass" name="pass" value="<?php echo desencript($row['pass']); ?>" disabled>
				<label><input type="checkbox" id="ver">Ver Contraseña</label>
				<br><br>
				<label>PERMISO</label><P>
				<select id="id_priv" name="id_priv" class="form form-control" disabled>
					<?php

						if ($resP->num_rows > 0) {
							while($rowP = $resP->fetch_assoc()){
							if($row['id_priv'] == $rowP['id_priv']){
								echo "<option value='".$rowP['id_priv']."' selected>".$rowP['nombre_priv']."</option>";
							}else{
								echo "<option value='".$rowP['id_priv']."'>".$rowP['nombre_priv']."</option>";
							}
						}
					}
					?>
				</select>
				<br>
				<input type="submit"  id="guardar" name="ok" value="Guardar" class="btn btn-outline btn-primary btn-lg btn-block" style="display: none;">
			</form>
		</div>
	</div>
</div>
<div class="col-sm-3 col-sm-3 col-sm-3">

</div>

<?php
	}

	if(isset($_POST['ok'])){
		$dui = encript($_POST['dui']);
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$pass = encript($_POST['pass']);

		$sql = "UPDATE candidato set nombres='".$nombres."', apellidos='".$apellidos."' WHERE dui='".$dui."'";
		$sqlCuenta = "UPDATE cuenta set pass='".$pass."', chPass='0' where idUsuario='".$dui."'";
		if($conn->query($sql) == true){
			$_SESSION["nombre"]=$nombres." ".$apellidos;
			if($conn->query($sqlCuenta) == true){

				echo "<script>alert('Perfil actualizado satisfactoriamente.');
				document.location='./?a=".encript("profileC.php")."';
				</script>";
			}
		}
	}
?>
