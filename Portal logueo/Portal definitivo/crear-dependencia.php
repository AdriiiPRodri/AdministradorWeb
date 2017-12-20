<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		//Formulario de creacion de dependencias
			echo "<br><form method='post' action='script_crear_dependencia.php' align='center' name='formulario_depen'>
				<STRONG>Nombre dependencia:</STRONG>&nbsp;&nbsp;<input name='nombre_de' type='text'><BR/><br>
				<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_de' type='text'><BR/><br>
				<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;<input name='ubicacion_de' type='text'><BR/><br>				
				<p>Elige el departamento: ";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select name='Departamento' onChange='document.form.submit()';>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select><br><br>
				<input name='accept' type='submit' value='Enviar'>
				<input name='borrar' type='reset' value='Borrar'><br><br>
				</form>";
	}	
		include "footer.php";
?>
	</body>
</html>