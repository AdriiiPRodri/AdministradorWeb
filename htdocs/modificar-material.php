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
		$mod="SELECT * FROM materiales WHERE ID_material="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara la dependencia:
		echo "<br><form method='post' action='script_modificar_material.php' align='center' name='formulario_modificacion_material'>
			<input name='material_mod' type='hidden' value='".$modif[0]."'></input>
			<div class='superior'><label name='campo'>Nombre:</label>&nbsp;&nbsp;<input class='campo' name='desc_material_mod' type='text' value='".$modif[1]."'></div>
			<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='tipo'>Tipo:</label><select class='selectcaja' name='tipo' onChange='document.form.submit()';>
				<option value='".$modif[3]."' checked='checked'>".$modif[3]."</option>
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
			<label name='ubi_material_mod'>Unidades totales:</label><input class='campo' name='ubi_material_mod' type='text' value='".$modif[2]."'>
			<div class='inferior'><input class='envio' name='accept' type='submit' value='Modificar'/>
			<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
			</form></div></div>";
		
	}	
		include "footer.php";
?>
	</body>
</html>