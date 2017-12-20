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
		$mod="SELECT * FROM dependencias WHERE Nombre_dependencia="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		//Crearemos un formulario sobre el cual se modificara la dependencia:
		echo "<form method='post' action='script_modificar_dependencia.php' align='center' name='formulario_modificacion_dependencia'>
		<input name='dependencia_mod' type='hidden' value='".$modif[0]."'></input>
		<div class='superior'><label name='desc_dependencia_mod'>Descripcion:</label><textarea class='campo area' name='desc_dependencia_mod' type='text' value='".$modif[1]."'></textarea></div>
		
		<div class='margen-t-b'><label name='Departamento'>Elige el departamento:</label>";
		//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
		$departamento="SELECT Nombre_departamento FROM departamento";
		$d=mysql_query($departamento, $conexion);
		echo "<select class='selectcaja' name='Departamento' onChange='document.form.submit()';>
		<option value='".$modif[3]."'>".$modif[3]."</option>";
		while ($z = mysql_fetch_row ($d)) {	
			foreach ($z as $valor) {
				echo "<option value='".$valor."'>".$valor."</option>";
			}
		}				
		echo "</select></div>
		<div class='margen-t-b'><label name='ubi_dependencia_mod'>Ubicacion:</label><input class='campo' name='ubi_dependencia_mod' type='text' value='".$modif[2]."'><div/>
		<div class='margen-t-b'><input class='envio' name='accept' type='submit' value='Modificar'/>
		<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
		</form></div></div>";
	}	
	include "footer.php";
?>
	</body>
</html>