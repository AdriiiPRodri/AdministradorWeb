<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
		//Formulario de creacion de incidencias
		echo "<form method='post' action='script_crear_departamento.php' align='center' name='formulario_depart'>
			<div class='superior'><label name='nombre_d'>Nombre departamento:</label><input class='campo' name='nombre_d' type='text'></div>
			<div class='margen-t-b'><label>Descripcion:</label><textarea class='campo area' name='descripcion_d' type='text'></textarea></div>
			<div class='margen-t-b'><label>Ubicacion:</label><input class='campo' name='ubicacion_d' type='text'></div>
			<div class='inferior'><input class='envio' name='accept' type='submit' value='Enviar'>
			<input class='envio' name='borrar' type='reset' value='Borrar'></div>
			</form></div></div>";
	}	
		include "footer.php";
?>
	</body>
</html>