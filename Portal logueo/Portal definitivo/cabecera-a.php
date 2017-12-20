<div class="col-sm-12">
	<div class="col-md-3 pull-left">Usted a accedido como: <?php echo $_COOKIE['nick']  ?></div>
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
				<div class="col-sm-3 col-md-3 col-lg-3 caja1" onclick="abrir('1')">
					GESTION DE USUARIOS
				</div></a>
				<div class="col-sm-3 col-md-3 col-lg-3 caja1" onclick="abrir('2')">
					GESTION DE INCIDENCIAS
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 caja1" onclick="abrir('3')">
					GESTION DE MATERIALES
				</div><div class="col-sm-3 col-md-3 col-lg-3 caja1" onclick="abrir('4')">
					GESTION DE DEPARTAMENTOS
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-12 col-lg-12 col-md-12 oculta" id="1">
	<a href="crear-usuario.php"><div class="col-sm-3 col-md-3 col-lg-3">NUEVO USUARIO</div></a>
	<a href="usuarios.php"><div class="col-sm-3 col-md-3 col-lg-3">TODOS LOS USUARIOS</div></a>
	<a href="historial.php"><div class="col-sm-3 col-md-3 col-lg-3">HISTORIAL</div></a>
	<a href="eliminados.php"><div class="col-sm-3 col-md-3 col-lg-3">USUARIOS ELIMINADOS</div></a>
</div>
<div class="col-sm-12 col-lg-12 col-md-12 oculta" id="2">
	<a href="crear-incidencia.php"><div class="col-sm-3 col-md-3 col-lg-3">NUEVA INCIDENCIA</div></a>
	<a href="no-corregidas.php"><div class="col-sm-3 col-md-3 col-lg-3">NO CORREGIDAS</div></a>
	<a href="pendientes.php"><div class="col-sm-3 col-md-3 col-lg-3">PENDIENTES</div></a>
	<a href="corregidas.php"><div class="col-sm-3 col-md-3 col-lg-3">CORREGIDAS</div></a>
</div>
<div class="col-sm-12 col-lg-12 col-md-12 oculta" id="3">
	<a href="crear-material.php"><div class="col-sm-3 col-md-3 col-lg-3">NUEVO MATERIAL</div></a>
	<a href="materiales.php"><div class="col-sm-3 col-md-3 col-lg-3">TODOS LOS MATERIALES</div></a>
	<a href="contiene.php"><div class="col-sm-3 col-md-3 col-lg-3">MATERIAL POR DEPENDENCIA</div></a>
</div>
<div class="col-sm-12 col-lg-12 col-md-12 oculta" id="4">
	<a href="crear-departamento.php"><div class="col-sm-3 col-md-3 col-lg-3">NUEVO DEPARTAMENTO</div></a>
	<a href="crear-dependencia.php"><div class="col-sm-3 col-md-3 col-lg-3">NUEVA DEPENDENCIA</div></a>
	<a href="departamentos.php"><div class="col-sm-3 col-md-3 col-lg-3">TODOS LOS DEPARTAMENTOS</div></a>
	<a href="dependencias.php"><div class="col-sm-3 col-md-3 col-lg-3">TODAS LAS DEPENDENCIAS</div></a>
</div>