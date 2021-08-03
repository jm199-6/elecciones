<div class="row">
    <div class="col-md-12">

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <!-- El logotipo y el icono que despliega el menú se agrupan
		  para mostrarlos mejor en los dispositivos móviles -->
	    <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		    <span class="sr-only">Desplegar navegación</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="./">Inicio</a>
	    </div>

	    <!-- Agrupar los enlaces de navegación, los formularios y cualquier
		  otro elemento que se pueda ocultar al minimizar la barra -->
	    <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
		    <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-flag"></i>  <b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<!-- Partido o comunidad depende del entorno de instalacion -->
			    <li><a href='#'></a></li>
			</ul>
		    </li>

		</ul>
		<p class="navbar-text pull-right">
		    <!-- al dar click sobre el nombre lo lleva a una pagina en la que puede
		    editar su informacion personal y cambiar la contraseña-->
		    Conectado como <a href="?a=<?php
        if($_SESSION["type"]=="candidato"){
          echo encript("profileC.php");
        }else{
          echo encript("profile.php");
        }
         ?>" class="navbar-link"><?php echo $_SESSION['nombre'];?></a>
		    <!-- Enlace para cerrar la sesion -->
		    &lsqb;<a href="../comunes/cerrar.php" class="navbar-link"><span class="fa fa-sign-out"></span> Cerrar Sesion</a>&rsqb;
		</p>
	    </div>


	    <!-- Presenta con qué usuario se ha iniciado sesion -->

	</nav>
    </div>

</div>
