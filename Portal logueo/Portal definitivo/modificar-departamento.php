<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		$mod="SELECT * FROM departamento WHERE Nombre_departamento="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara el departamento:
		echo "<br><form method='post' action='script_modificar_departamento.php' align='center' name='formulario_modificacion_departamento'>
			<input name='departamento_mod' type='hidden' value='".$modif[0]."'></input>
			<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='desc_departamento_mod' type='text' value='".$modif[1]."'><BR/><br>
			<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;&nbsp;<input name='ubi_departamento_mod' type='text' value='".$modif[2]."'><br/><br>
			<input name='accept' type='submit' value='Modificar'/>
			<input name='borrar' type='reset' value='Restaurar'>
			</form>";
	
	}	
	include "footer.php";
?>
	</body>
</html>