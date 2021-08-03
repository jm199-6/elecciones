<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" enctype='multipart/form-data'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Registrate</h4>
                </div>
                <div class="modal-body">
                	<!-- CAMPOS DEL FORMULARIO-->
                    <div id="nUsuarioN" class="form-group input-group">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								<i class="fa fa-user"></i>
							</font>
						</span>
						<input required class='form-control' id="dui" maxlength="10" type="text" name="dui_u" placeholder="Numero de DUI" pattern="[0-9\-]{10,10}" title="Tamaño mínimo: 10. Tamaño máximo: 10" />
					</div>

					<div id="nombresN" class="form-group input-group">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								NOMBRES
							</font>
						</span>
						<input required class='form-control' id="nombres"  onKeyUp="this.value=this.value.toUpperCase();" maxlength="150" type="text" name="nombres" placeholder="Nombres" pattern="[a-zA-Z0-9\-\ ]{1,150}" title="Tamaño mínimo: 1. Tamaño máximo: 150" />
					</div>

					<div id="apellidosN" class="form-group input-group">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								APELLIDOS
							</font>
						</span>
						<input required class='form-control' id="apellidos" onKeyUp="this.value=this.value.toUpperCase();" maxlength="150" type="text" name="apellidos" placeholder="Apellidos" pattern="[a-zA-Z0-9\-\ ]{1,150}" title="Tamaño mínimo: 1. Tamaño máximo: 150" />
					</div>

					<div id="direccionN" class="form-group input-group">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								DIRECCION
							</font>
						</span>
						<input required class='form-control' id="direccion" onKeyUp="this.value=this.value.toUpperCase();" maxlength="150" type="text" name="direccion" placeholder="Direccion" pattern="[a-zA-Z0-9\-\ ]{10,250}" title="Tamaño mínimo: 10. Tamaño máximo: 250" />
					</div>

					<div id="cUsuarioN" class="form-group input-group">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								<i class="fa fa-lock"></i>
							</font>
						</span>
						<input required class='form-control' id="p" type="password" name="p" placeholder="Contraseña" pattern="[a-zA-Z0-9\-]{6,250}" title="La Contraseña debe contener a-z A-Z y numeros. Tamaño mínimo: 6. Tamaño máximo: 250" />
						<span class="input-group-btn">
							<button id="ver" type="button" class="btn btn-default"><i class="fa fa-eye" id="icVer"></i>&nbsp;</button>
						</span>
						<input type="hidden" name="id_priv" value="2" >
					</div>

					<div id="rcUsuarioN" class="form-group input-group ">
						<span class="input-group-addon">
							<font style="vertical-align:inherit;">
								<i class="fa fa-unlock-alt"></i>
							</font>
						</span>
						<input required class='form-control' id="rP" type="password" name="rP" placeholder="Confirme Contraseña" pattern="[a-zA-Z0-9\-]{6,250}" title="La Contraseña debe contener a-z A-Z y numeros. Tamaño mínimo: 6. Tamaño máximo: 250" />
						<span class="input-group-btn">
								<button id="rVer" type="button" class="btn btn-default"><i class="fa fa-eye" id="icRVer"></i>&nbsp;</button>
						</span>
					</div>

					<!--FIN CAMPOS DEL FORMULARIO -->
					<div id="passwords" style="display: none;" class="alert  alert-dismissable">
                        <font style="vertical-align: inherit; float: right;">
                    		<i class="fa" id="icPasswords"></i>
                    	</font>

                        <label style="vertical-align: inherit;" id="texto"></label>

                	</div>
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
