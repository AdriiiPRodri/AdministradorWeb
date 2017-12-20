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
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><h3>Materiales</h3></div><hr>";
		//Tabla de departamentos:
			$select = mysql_query("SELECT * FROM materiales", $conexion);
			//Generamos la tabla:
			echo "<table class='tabla'>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'materiales'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th class='atributos'>".$valor."</th>";
					}
			}
			//Vamos a crear una columna para el boton de borrar y modificar
			echo "<th class='atributos'>Modificar</th>";
			echo "<th class='atributos'>Borrar</th>";
			$a=0;	$b=0;			
			//Valores de la tabla de materiales
			//Vamos a crear un botn que nos genere un pdf de manera automatica para eliminar paneles innecesarios y agilizar el trabajo, para ello,
			//necesitamos crear un array que nos vaya recogiendo los valores de la variable del foreach $valor, una vez heca esta variable, necesitamos
			//poner en un campo oculto del formulario el valor de la variable $array con este esquema $array[$a][0] donde el segundo campo siempre
			//va a ser 0 para que nos coja siempre el id de la incidencia
			//Haremos esto mismo tambien para el boton de borrar y modificar
			while ($z = mysql_fetch_row ($select)) {
				echo "<tr>";
					foreach ($z as $valor) {
						echo "<td class='valores'>".$valor."</td>";
						$array[$a][$b]=$valor;
						$b++;
					}
				echo "<td class='valores'><form method='post' action='modificar-material.php' align='center' name='formulario_material'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='mod'>";
				echo "<input name='accept' type='submit' value='M' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td class='valores'><form method='post' action='script_borrar_material.php' align='center' name='formulario_material_borrar'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='baja'>";
				echo "<input name='accept' type='submit' value='X' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
				$a++;
				$b=0;
			}
			echo "</table></div></div>";
		
	}	
		include "footer.php";
?>
	</body>
</html>