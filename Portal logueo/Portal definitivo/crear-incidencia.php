<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Normal'){

		include "cabecera-u.php";

		//Formulario de creacion de incidencias
		echo "<br><form method='post' action='script_creacion_incidencias.php' align='center' name='formulario_cinci'>
			<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion' type='text'><BR/><br>
			</select>
			<STRONG>Dependencia:</STRONG>";
			//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
			$dependencias="SELECT Nombre_dependencia FROM dependencias";
			$d=mysql_query($dependencias, $conexion);
			echo "<select name='Dependencia' onChange='document.form.submit()';><table>";
			while ($z = mysql_fetch_row ($d)) {	
				foreach ($z as $valor) {
					echo "<option value='".$valor."'>".$valor."</option>";
				}
			}				
			echo "</select><br><br>
			<STRONG>Tipo:</STRONG>
			<select name='tipo' onChange='document.form.submit()';>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select><br><br>
			<STRONG>Comentario:</STRONG>&nbsp;&nbsp;<input name='coment' type='text'><BR/><br>
			<input name='accept' type='submit' value='Enviar'>
			<input name='borrar' type='reset' value='Borrar'><br><br>
			<STRONG>El departamento al que perteneces y la fecha y hora se colocaran de manera automatica</STRONG><br><br>
			</form>";
	}
	
	if($administracion == 'Administrador'){

		include "cabecera-a.php";

		//Formulario de creacion de incidencias
		echo "<br><form method='post' action='script_creacion_incidencias.php' align='center' name='formulario_cinci'>
			<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion' type='text'><BR/><br>
			</select>
			<STRONG>Dependencia:</STRONG>";
			//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
			$dependencias="SELECT Nombre_dependencia FROM dependencias";
			$d=mysql_query($dependencias, $conexion);
			echo "<select name='Dependencia' onChange='document.form.submit()';><table>";
			while ($z = mysql_fetch_row ($d)) {	
				foreach ($z as $valor) {
					echo "<option value='".$valor."'>".$valor."</option>";
				}
			}				
			echo "</select><br><br>
			<STRONG>Tipo:</STRONG>
			<select name='tipo' onChange='document.form.submit()';>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select><br><br>
			<STRONG>Comentario:</STRONG>&nbsp;&nbsp;<input name='coment' type='text'><BR/><br>
			<input name='accept' type='submit' value='Enviar'>
			<input name='borrar' type='reset' value='Borrar'><br><br>
			<STRONG>El departamento al que perteneces y la fecha y hora se colocaran de manera automatica</STRONG><br><br>
			</form>";
	}
	
	include "footer.php";
?>
	</body>
</html>