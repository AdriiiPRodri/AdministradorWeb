<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php

	if($administracion == 'Normal'){
		include "cabecera-u.php";
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
		$mod="SELECT * FROM gestionabdera.incidencias WHERE N_incidencia="."'".$_POST['mod']."' AND Usuario='".$_COOKIE['nick']."' AND Estado='NO CORREGIDO';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<form method='post' action='script_modificar_incidencia.php' align='center' name='formulario_modificacion'>";
			echo "<div class='superior'><label name='descripcion_mod'>Descripcion:</label><input class='campo' name='descripcion_mod' type='text' value='".$modif[1]."'></div>
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='dependencia_mod'>Elige una dependencia</label>
			<select class='selectcaja' name='Dependencia_mod' onChange='document.form.submit()';>
				<option value='".$modif[2]."' checked='checked'>".$modif[2]."</option>
				<option value='Aula 6'>Aula 6</option>
				<option value='Aula 7'>Aula 7</option>
			</select></div>
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='tipo'>Tipo:</label>
			<select class='selectcaja' name='tipo' onChange='document.form.submit()';>
				<option value='".$modif[5]."' checked='checked'>".$modif[5]."</option>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select></div>
			<div class='margen-t-b'><label name='coment_mod'>Comentario:</label><textarea class='campo area' name='coment_mod' type='text' value='".$modif[8]."'></textarea></div>
			<div class='margen-t-b'>
			<input type='hidden' name='N_incidencia' value='".$_POST['mod']."'></input>
			<input class='envio' name='accept' type='submit' value='Modificar'/>
			<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
			</form><div class='inferior'><h5>El ID de la incidencia y el usuario que la ha creado no se puede modificar.</h5></div></div></div></div>";
			
	}
	
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
				//Es un usuario con privilegio de "Administrador".
			$mod="SELECT * FROM gestionabdera.incidencias WHERE N_incidencia="."'".$_POST['mod']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<form method='post' action='script_modificar_incidencia.php' align='center' name='formulario_modificacion'>";
				echo "<div class='superior'><label name='descripcion_mod'>Descripcion:</label><input class='campo' name='descripcion_mod' type='text' value='".$modif[1]."'></div>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Dependencia_mod'>Elige una dependencia</label>";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
				$dependencias="SELECT Nombre_dependencia FROM dependencias";
				$d=mysql_query($dependencias, $conexion);
				echo "<select class='selectcaja' name='Dependencia_mod' onChange='document.form.submit()';><table>";
				echo "<option value='".$modif[2]."'>".$modif[2]."</option><BR/><br>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select></div>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='tipo'>Tipo:</label>
				<select class='selectcaja' name='tipo' onChange='document.form.submit()';>
					<option value='".$modif[5]."' checked='checked'>".$modif[5]."</option>
					<option value='TIC'>TIC</option>
					<option value='Mobiliario'>Mobiliario</option>
					<option value='Otros'>Otros</option>
				</select></div>
				<div class='margen-t-b'><label name='estado'>Estado:</label>
				<select class='selectcaja' name='estado' onChange='document.form.submit()';>
					<option value='".$modif[4]."' checked='checked'>".$modif[4]."</option>
					<option value='NO CORREGIDO'>NO CORREGIDO</option>
					<option value='PENDIENTE'>PENDIENTE</option>
					<option value='CORREGIDO'>CORREGIDO</option>
				</select></div>
				<div class='margen-t-b'><label name='coment_mod'>Comentario:</label><textarea class='campo area' name='coment_mod' type='text' value='".$modif[8]."'></textarea></div>
				<div class='inferior'><input type='hidden' name='N_incidencia' value='".$_POST['mod']."'></input>
				<input class='envio' name='accept' type='submit' value='Modificar'/>
				<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
				</form>
				<div class='inferior'><h5>El ID de la incidencia y el usuario que la ha creado no se puede modificar.</h5></div></div></div></div>";
		
	}
	
	include "footer.php";
?>
	</body>
</html>