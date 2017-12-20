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
		//Formulario de creacion de incidencias
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'><form method='post' action='script_creacion_incidencias.php' align='center' name='formulario_cinci'>
			<div class='superior'><label name='descripcion'>Descripcion:</label>
			<input class='campo' name='descripcion' type='textarea'></div>
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 inferior'><label name='dependencia'>Dependencia:</label>";
			
			//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
			$dependencias="SELECT Nombre_dependencia FROM dependencias";
			$d=mysql_query($dependencias, $conexion);
			
			echo "<select class='selectcaja' name='Dependencia' onChange='document.form.submit()';>";
			while ($z = mysql_fetch_row ($d)) {	
				foreach ($z as $valor) {
					echo "<option value='".$valor."'>".$valor."</option>";
				}
			}				
			echo "</select></div>
			
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 inferior'><label name='tipo'>Tipo:</label><select class='selectcaja' name='tipo' onChange='document.form.submit()';</div>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select></div>
			<div class='margen-t-b'><label name='coment'>Comentario:</label>
			<textarea class='campo area' name='coment'></textarea></div>
			<div class='margen-t-b'><input class='envio' name='accept' type='submit' value='Enviar'>
			<input class='envio' name='borrar' type='reset' value='Borrar'></div>
			<div class='inferior'><h5>El departamento al que perteneces y la fecha y hora se colocaran de manera automatica</h5></div>
			</form></div></div>";
	}
	
	if($administracion == 'Administrador'){

		include "cabecera-a.php";
		
		echo "<div class='container contenedor'>";
		//Formulario de creacion de incidencias
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-5 caja4'><form method='post' action='script_creacion_incidencias.php' align='center' name='formulario_cinci'>
			<div class='superior'><label name'descripcion'>Descripcion:</label>
			<input class='campo' name='descripcion' type='textarea'></div>
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 inferior'><label name='dependencia'>Dependencia:</label>";
			
			//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Dependencias
			$dependencias="SELECT Nombre_dependencia FROM dependencias";
			$d=mysql_query($dependencias, $conexion);
			
			echo "<select class='selectcaja' name='Dependencia' onChange='document.form.submit()';>";
			while ($z = mysql_fetch_row ($d)) {	
				foreach ($z as $valor) {
					echo "<option value='".$valor."'>".$valor."</option>";
				}
			}				
			echo "</select></div>
			
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 inferior'><label name='tipo'>Tipo:</label><select class='selectcaja' name='tipo' onChange='document.form.submit()';</div>
				<option value='TIC'>TIC</option>
				<option value='Mobiliario'>Mobiliario</option>
				<option value='Otros'>Otros</option>
			</select></div>
			<div class='margen-t-b'><label name='coment'>Comentario:</label>
			<textarea class='campo area' name='coment'></textarea></div>
			<div class='margen-t-b'><input class='envio' name='accept' type='submit' value='Enviar'>
			<input class='envio' name='borrar' type='reset' value='Borrar'></div>
			<div class='inferior'><h5>El departamento al que perteneces y la fecha y hora se colocaran de manera automatica</h5></div>
			</form></div></div>";
	}
	
	include "footer.php";
?>
	</body>
</html>