<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		$mod="SELECT * FROM dependencias WHERE Nombre_dependencia="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara la dependencia:
		echo "<br><form method='post' action='script_modificar_dependencia.php' align='center' name='formulario_modificacion_dependencia'>
		<input name='dependencia_mod' type='hidden' value='".$modif[0]."'></input>
		<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='desc_dependencia_mod' type='text' value='".$modif[1]."'><BR/><br>
		<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;&nbsp;<input name='ubi_dependencia_mod' type='text' value='".$modif[2]."'><br/><br>
		<p>Elige el departamento: ";
		//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
		$departamento="SELECT Nombre_departamento FROM departamento";
		$d=mysql_query($departamento, $conexion);
		echo "<select name='Departamento' onChange='document.form.submit()';>
		<option value='".$modif[3]."'>".$modif[3]."</option>";
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