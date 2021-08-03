<div class="row">
    <div class=" col-md-12">
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
                     Gestionar <b class="caret"></b>
                     <ul class="dropdown-menu">
               				<!-- Partido o comunidad depende del entorno de instalacion -->
               			    <li><a href='?a=<?php echo encript("partidos.php"); ?>'> <i class="fa fa-flag"></i> Partidos</a></li>
                        <li><a href='?a=<?php echo encript("candidatos.php"); ?>'><i class="fa fa-users"></i> Candidatos</a></li>
                        <li><a href='?a=<?php echo encript("usuarios.php"); ?>'><i class="fa fa-user"></i> Usuarios Registrados</a></li>
                        <li><a href='?a=<?php echo encript("puestos.php"); ?>'><i class="fa fa-bars"></i> Puestos</a></li>
                    </ul>
                </a>
              </li>
        		</ul>
            <ul class="nav navbar-nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['nombre'];?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?a=<?php echo encript("profile.php"); ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../comunes/cerrar.php"><i class="fa fa-sign-out-alt fa-fw"></i> Cerrar Sesion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
    	    </div>
    	    <!-- Presenta con qué usuario se ha iniciado sesion -->
    	</nav>
    </div>
</div>
