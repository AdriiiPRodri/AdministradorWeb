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
		//Formulario de creacion de dependencias
			echo "<form method='post' action='script_crear_dependencia.php' align='center' name='formulario_depen'>
				<div class='superior'><label name='campo'>Nombre dependencia:</label><input class='campo' name='nombre_de' type='text'></div>
				<div class='margen-t-b'><label name='descripcion_de'>Descripcion:</label><textarea class='campo area' name='descripcion_de' type='text'></textarea></div>				
				<div class='margen-t-b'><label name='Departamento'>Elige el departamento:</label>";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select class='selectcaja' name='Departamento' onChange='document.form.submit()';>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select></div>
				<div class='margen-t-b'><label name='ubicacion_de'>Ubicacion:</label><input class='campo' name='ubicacion_de' type='text'></div>
				<div class='inferior'><input class='envio' name='accept' type='submit' value='Enviar'>
				<input class='envio' name='borrar' type='reset' value='Borrar'></div>
				</form></div></div>";
	}	
		include "footer.php";
?>
	</body>
</html>