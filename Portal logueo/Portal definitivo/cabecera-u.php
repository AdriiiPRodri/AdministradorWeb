<div class="col-sm-12">
	<div class="col-md-3 pull-left">Información del centro o usuario</div>
	<div class="col-md-8 navbar-right text-right"><a href="logout.php">Desconexión</a></div>
</div>
		
<div class="col-sm-12 cabecera">
	<div class="container cabecera">
		<div class="col-sm-3 pager">
			<a href="logout.php"><img class="logo" src="images/logo.png" width="75%"></a>
		</div>
		<div class="col-sm-9">
			<div class="col-sm-12 caja2 hidden-sm hidden-md hidden-xs">
				&nbsp;
			</div>
			
			<div class="hidden-xs col-md-12 col-lg-12">
				<a href="crear-incidencia.php"><div class="col-sm-6 col-md-6 col-lg-6 caja1">
					NUEVA INCIDENCIA
				</div></a>
				<div class="col-sm-6 col-md-6 col-lg-6 caja1" onclick="abrir('1')">
					MIS INCIDENCIAS
				</div>
				<a href="modificar-usuario.php"><div class="col-sm-6 col-md-6 col-lg-6 caja1">
					MIS DATOS
				</div></a>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-12 col-lg-12 col-md-12 oculta" id="1">
	<a href="no-corregidas.php"><div class="col-sm-4 col-md-4 col-lg-4">NO CORREGIDAS</div></a>
	<a href="pendientes.php"><div class="col-sm-4 col-md-4 col-lg-4">PENDIENTES</div></a>
	<a href="corregidas.php"><div class="col-sm-4 col-md-4 col-lg-4">CORREGIDAS</div></a>
</div>
