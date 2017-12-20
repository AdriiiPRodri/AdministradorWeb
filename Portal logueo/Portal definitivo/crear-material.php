<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		//Formulario de creacion de materiales
		echo "<br><form method='post' action='script_crear_material.php' align='center' name='formulario_mat'>
		<STRONG>ID del material:</STRONG>&nbsp;&nbsp;<input name='id_m' type='text'><BR/><br>
		<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='nombre_m' type='text'><BR/><br>
		<STRONG>Unidades totales:</STRONG>&nbsp;&nbsp;<input name='unidades_m' type='number'><BR/><br>
		<STRONG>Tipo:</STRONG>
		<select name='tipo' onChange='document.form.submit()';>
			<option value='TIC'>TIC</option>
			<option value='Mobiliario'>Mobiliario</option>
			<option value='Otros'>Otros</option>
		</select><br><br>
		<STRONG>Dependencia:</STRONG>";
		$dependencias="SELECT Nombre_dependencia FROM dependencias";
		$d=mysql_query($dependencias, $conexion);
		echo "<select name='Dependencia' onChange='document.form.submit()';><table>";
		while ($z = mysql_fetch_row ($d)) {	
			foreach ($z as $valor) {
				echo "<option value='".$valor."'>".$valor."</option>";
			}
		}				
		echo "</select><br><br>
		<input name='accept' type='submit' value='Enviar'>
		<input name='borrar' type='reset' value='Borrar'><br><br>
		</form>";
		
	}
	
	include "footer.php";
?>
	</body>
</html>