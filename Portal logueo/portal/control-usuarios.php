<html>
	<head>
		<?php
			include 'head.php';
		?>
		
	</head>
	
	<body class="body">
		<?php
			include 'cabecera2.php';
		?>
	
		<div class="container contenedor">
			<!--Contenido pagina principal, esta estará antes del login para que puedan acceder a las distintas herramientas los usuarios hasta que se cree un login único, aquí habrá una breve descripción, si encuentro el código en internet aquí el texto irá cambiando por lo que vayamos a poner en cada caja-->
			<div class="col-sm-12 col-xs-12">
				<div class="col-xs-4 col-sm-2 caja5">Nuevo usuario</div>
				<div class="col-xs-4 col-sm-2 caja5">Eliminar usuario</div>
				<div class="col-xs-4 col-sm-2 caja5">Moificar usuario</div>
				<div class="col-xs-4 col-sm-2 caja5">Control de acceso</div>
				<div class="col-xs-4 col-sm-2 caja5">Privilegios</div>
				<div class="col-xs-4 col-sm-2 caja5">Historial de usuarios</div>
			</div>
			<hr>
			<div class="col-sm-12">
					Tablas de incidencias en proceso y no corregidas
			</div>
		</div>
		
		<?php
			include 'footer.php';
		?>
	
	</body>
</html>