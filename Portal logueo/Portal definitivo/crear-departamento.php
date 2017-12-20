<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		//Formulario de creacion de incidencias
		echo "<br><form method='post' action='script_crear_departamento.php' align='center' name='formulario_depart'>
			<STRONG>Nombre departamento:</STRONG>&nbsp;&nbsp;<input name='nombre_d' type='text'><BR/><br>
			<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_d' type='text'><BR/><br>
			<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;<input name='ubicacion_d' type='text'><BR/><br>				
			<input name='accept' type='submit' value='Enviar'>
			<input name='borrar' type='reset' value='Borrar'><br><br>
			</form>";
	}	
		include "footer.php";
?>
	</body>
</html>