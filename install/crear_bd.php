<html>
<head>
	<?php
	include("../referencias.php");
	require_once "../comunes/encript.php";
	?>
</head>
<body>

<div class='conte'>

</div>
	<?php

	if (isset($_POST['crear'])) {
		$server = $_POST['server'];
		$user = $_POST['user'];
		$password = $_POST['password'];
		//$user_sis = $_POST['user_sis'];
		//$password_sis = $_POST['password_sis'];

		$DB = $_POST['bd'];

		$conn = new mysqli($server,$user,$password,'');
		if ($conn->connect_error)
		{
			echo "<script>
			document.getElementById('msjError').innerHTML = 'Ha ocurrido un error al intentar conectarse con el servidor y usuario especificado especificado.';
        	flotante(6);</script>";
		}

		$use="USE ".$DB;
		$sqldrop=array('1' => "DROP TABLE IF EXISTS `voto_candidato`",
			"DROP TABLE IF EXISTS `puesto`",
			"DROP TABLE IF EXISTS `candidato`",
			"DROP TABLE IF EXISTS `partido`;",
			"DROP TABLE IF EXISTS `usuario`;",
			"DROP TABLE IF EXISTS `cuenta`;",
			"DROP TABLE IF EXISTS `privilegio`;"
			);



		$sqltable= array('1' => "
		CREATE TABLE `partido` (
		  `id_partido` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre_partido` varchar(250) NOT NULL,
		  `logo_partido` varchar(250) DEFAULT NULL,
		  PRIMARY KEY (`id_partido`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;",

		"
		CREATE TABLE `puesto` (
		  `id_puesto` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre_puesto` varchar(250) NOT NULL,
		  PRIMARY KEY (`id_puesto`)
		) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;",

		"
		  CREATE TABLE `candidato` (
		  `dui` varchar(100) NOT NULL,
		  `nombres` varchar(150) NOT NULL,
		  `apellidos` varchar(150) NOT NULL,
		  `foto` varchar(250) DEFAULT NULL,
		  `id_partido` int(11) DEFAULT NULL,
		  PRIMARY KEY (`dui`),
		  KEY `id_partido` (`id_partido`),
		  CONSTRAINT `candidato_ibfk_1` FOREIGN KEY (`id_partido`) REFERENCES `partido` (`id_partido`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

		"
		CREATE TABLE `privilegio` (
		  `id_priv` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre_priv` varchar(100) NOT NULL,
		  PRIMARY KEY (`id_priv`)
		) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;",
		"
		CREATE TABLE `cuenta` (
		  `idUsuario` varchar(100) NOT NULL,
		  `pass` varchar(250) NOT NULL,
		  `idPriv` int(11) NOT NULL,
		  `chPass` char(1) NOT NULL DEFAULT '1' COMMENT '1 : Vence contra 0: no vence contra',
		  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT 'A : activo para votar I: inactivo para votar',
		  PRIMARY KEY (`idUsuario`),
		  CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`idPriv`) REFERENCES `privilegio` (`id_priv`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

		"
		CREATE TABLE `usuario` (
		  `dui` varchar(100) NOT NULL,
		  `idUsuario` varchar(100) NOT NULL COMMENT 'El dui sera el idUsuario para la cuenta',
		  `nombres` varchar(150) NOT NULL,
		  `apellidos` varchar(150) NOT NULL,
		  `direccion` varchar(250) NOT NULL,
		  PRIMARY KEY (`dui`),
		  KEY `idUsuario` (`idUsuario`),
		  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `cuenta` (`idUsuario`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

		"
		CREATE TABLE `voto_candidato` (
		  `id_voto` int(11) NOT NULL AUTO_INCREMENT,
		  `dui_candidato` varchar(100) NOT NULL,
		  `dui_usuario` varchar(100) NOT NULL,
		  `fecha_votacion` varchar(10) NOT NULL,
		  PRIMARY KEY (`id_voto`),
		  KEY `dui_candidato` (`dui_candidato`),
		  CONSTRAINT `voto_candidato_ibfk_1` FOREIGN KEY (`dui_candidato`) REFERENCES `candidato` (`dui`),
		  CONSTRAINT `voto_candidato_ibfk_2` FOREIGN KEY (`dui_usuario`) REFERENCES `cuenta` (`idUsuario`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		$datos="INSERT INTO `privilegio`(`id_priv`,`nombre_priv`) VALUES (1,'admin'),(2,'usuario'),(3,'candidato');";

		$contTablas=count($sqltable);

		if ($conn->query($use)) {
				$cantTabcreadas=0;
				for($j=1; $j<=count($sqldrop); $j++){
					$conn->query($sqldrop[$j]);
					if($conn->error)
					{
						echo $conn->error;
					}
				}
				for ($i=1; $i <=$contTablas ; $i++) {
					if ($conn->query($sqltable[$i])){
						$cantTabcreadas++;
					}else {
						echo $conn->error;
					}
				}
				$conn->query($datos);

				$dropT = "DROP TRIGGER IF EXISTS iStatus";
				$trigger = "CREATE TRIGGER iStatus AFTER INSERT ON voto_candidato
				FOR EACH ROW BEGIN
					update cuenta set estado='I' where idUsuario=(SELECT dui_usuario FROM voto_candidato ORDER BY id_voto desc LIMIT 1 );
					END";
				$conn->query($dropT);
				$conn->query($trigger);

			echo "<script>window.location='./index.php?a=".encript("createAdmin.php")."&server=".$server."&user=".$user."&password=".$password."&bd=".$DB."'</script>";
		}else{
			echo "<script>document.getElementById('msjError').innerHTML = 'No se puede conectar con la base de datos especificada.';
			flotante(6);</script>";
		}


	}


?>



</body>
</html>
