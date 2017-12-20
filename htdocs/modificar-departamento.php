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
		$mod="SELECT * FROM departamento WHERE Nombre_departamento="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara el departamento:
		echo "<form method='post' action='script_modificar_departamento.php' align='center' name='formulario_modificacion_departamento'>
			<input name='departamento_mod' type='hidden' value='".$modif[0]."'></input>
			<div class='superior'><label name='desc_departamento_mod'>Descripcion:</label><textarea class='campo area' name='desc_departamento_mod' type='text' value='".$modif[1]."'></textarea></div>
			<div class='margen-t-b'><label name='ubi_departamento_mod'>Ubicacion:</label><input class='campo' name='ubi_departamento_mod' type='text' value='".$modif[2]."'></div>
			<div class='inferior'><input class='envio' name='accept' type='submit' value='Modificar'/>
			<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
			</form></div></div>";
	
	}	
	include "footer.php";
?>
	</body>
</html>