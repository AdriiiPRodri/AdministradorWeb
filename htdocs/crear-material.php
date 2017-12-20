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
		//Formulario de creacion de materiales
		echo "<form method='post' action='script_crear_material.php' align='center' name='formulario_mat'>
		<div clas='superior'><label class='campo' name='id_m'>ID del material:</label><input class='campo' name='id_m' type='text'></div>
		<div class='margen-t-b'><label name='nombre_m'>Descripcion:</label><input class='campo' name='nombre_m' type='text'></div>
		<div class='margen-t-b'><label name='unidades_m'>Unidades totales:</label><input class='campo' name='unidades_m' type='text'></div>
		<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='tipo'>Tipo:</label>
		<select class='selectcaja' name='tipo' onChange='document.form.submit()';>
			<option value='TIC'>TIC</option>
			<option value='Mobiliario'>Mobiliario</option>
			<option value='Otros'>Otros</option>
		</select></div>
		<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Dependencia'>Dependencia:</label>";
		$dependencias="SELECT Nombre_dependencia FROM dependencias";
		$d=mysql_query($dependencias, $conexion);
		echo "<select class='selectcaja' name='Dependencia' onChange='document.form.submit()';><table>";
		while ($z = mysql_fetch_row ($d)) {	
			foreach ($z as $valor) {
				echo "<option value='".$valor."'>".$valor."</option>";
			}
		}				
		echo "</select></div>
		<div class='superior'><input class='envio' name='accept' type='submit' value='Enviar'>
		<input class='envio' name='borrar' type='reset' value='Borrar'></div>
		</form></div></div></div>";
		
	}
	
	include "footer.php";
?>
	</body>
</html>