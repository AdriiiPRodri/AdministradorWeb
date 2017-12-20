<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		$mod="SELECT * FROM materiales WHERE ID_material="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara la dependencia:
		echo "<br><form method='post' action='script_modificar_material.php' align='center' name='formulario_modificacion_material'>
			<input name='material_mod' type='hidden' value='".$modif[0]."'></input>
			<STRONG>Nombre:</STRONG>&nbsp;&nbsp;<input name='desc_material_mod' type='text' value='".$modif[1]."'><BR/><br>
			<STRONG>Unidades totales:</STRONG>&nbsp;&nbsp;&nbsp;<input name='ubi_material_mod' type='text' value='".$modif[2]."'><br/><br>
			<STRONG>Tipo:</STRONG>
			<select name='tipo' onChange='document.form.submit()';>
				<option value='".$modif[3]."' checked='checked'>".$modif[3]."</option>
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
			<input name='accept' type='submit' value='Modificar'/>
			<input name='borrar' type='reset' value='Restaurar'>
			</form>";
		
	}	
		include "footer.php";
?>
	</body>
</html>