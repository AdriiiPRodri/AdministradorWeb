<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php

	if($administracion == 'Normal'){
		include "cabecera-u.php";
		
		$mod="SELECT * FROM gestionabdera.incidencias WHERE N_incidencia="."'".$_POST['mod']."' AND Usuario='".$_COOKIE['nick']."' AND Estado='NO CORREGIDO';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<br><form method='post' action='script_modificar_incidencia.php' align='center' name='formulario_modificacion'>
			<STRONG>El ID de la incidencia y el usuario que la ha creado no se puede modificar.<br><br>";
			echo "<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_mod' type='text' value='".$modif[1]."'><BR/><br>
			<p>Elige una dependencia
			<select name='Dependencia_mod' onChange='document.form.submit()';>
				<option value='".$modif[2]."' checked='checked'>".$modif[2]."</option>
				<option value='Aula 6'>Aula 6</option>
				<option value='Aula 7'>Aula 7</option>
			</select><br><br>
			<STRONG>Tipo:</STRONG>
			<select name='tipo' onChange='document.form.submit()';>
				<option value='".$modif[5]."' checked='checked'>".$modif[5]."</option>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select><br><br>
			<STRONG>Comentario:</STRONG>&nbsp;&nbsp;<input name='coment_mod' type='text' value='".$modif[8]."'><BR/><br>
			<input type='hidden' name='N_incidencia' value='".$_POST['mod']."'></input>
			<input name='accept' type='submit' value='Modificar'/>
			<input name='borrar' type='reset' value='Restaurar'>
			</form>";
			
	}
	
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
				//Es un usuario con privilegio de "Administrador".
			$mod="SELECT * FROM gestionabdera.incidencias WHERE N_incidencia="."'".$_POST['mod']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<br><form method='post' action='script_modificar_incidencia.php' align='center' name='formulario_modificacion'>
				<STRONG>El ID de la incidencia y el usuario que la ha creado no se puede modificar.<br><br>";
				echo "<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_mod' type='text' value='".$modif[1]."'><BR/><br>
				<p>Elige una dependencia";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
				$dependencias="SELECT Nombre_dependencia FROM dependencias";
				$d=mysql_query($dependencias, $conexion);
				echo "<select name='Dependencia_mod' onChange='document.form.submit()';><table>";
				echo "<option value='".$modif[2]."'>".$modif[2]."</option><BR/><br>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select><br><br>
				<STRONG>Estado:</STRONG>
				<select name='estado' onChange='document.form.submit()';>
					<option value='".$modif[4]."' checked='checked'>".$modif[4]."</option>
					<option value='NO CORREGIDO'>NO CORREGIDO</option>
					<option value='PENDIENTE'>PENDIENTE</option>
					<option value='CORREGIDO'>CORREGIDO</option>
				</select><br><br>
				<STRONG>Tipo:</STRONG>
				<select name='tipo' onChange='document.form.submit()';>
					<option value='".$modif[5]."' checked='checked'>".$modif[5]."</option>
					<option value='TIC'>TIC</option>
					<option value='Mobiliario'>Mobiliario</option>
					<option value='Otros'>Otros</option>
				</select><br><br>
				<STRONG>Comentario:</STRONG>&nbsp;&nbsp;<input name='coment_mod' type='text' value='".$modif[8]."'><BR/><br>
				<input type='hidden' name='N_incidencia' value='".$_POST['mod']."'></input>
				<input name='accept' type='submit' value='Modificar'/>
				<input name='borrar' type='reset' value='Restaurar'>
				</form>";
		
	}
	
	include "footer.php";
?>
	</body>
</html>