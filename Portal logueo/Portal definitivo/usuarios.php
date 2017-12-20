<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
			//Tabla de usuarios:
			$select = mysql_query("SELECT * FROM Usuarios", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='8'><h3 align=center>Usuarios del sistema</h3></tr>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Usuarios'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th>".$valor."</th>";
					}
			}
			//Vamos a crear una columna para el boton de generar pdf, borrar y modificar
			echo "<th>Modificar</th>";
			echo "<th>Borrar</th>";
			$a=0;	$b=0;			
			//Valores de la tabla de incidencias con estado NO CORREGIDO
			//Vamos a crear un botn que nos genere un pdf de manera automatica para eliminar paneles innecesarios y agilizar el trabajo, para ello,
			//necesitamos crear un array que nos vaya recogiendo los valores de la variable del foreach $valor, una vez heca esta variable, necesitamos
			//poner en un campo oculto del formulario el valor de la variable $array con este esquema $array[$a][0] donde el segundo campo siempre
			//va a ser 0 para que nos coja siempre el id de la incidencia
			//Haremos esto mismo tambien para el boton de borrar y modificar
			while ($z = mysql_fetch_row ($select)) {
				echo "<tr>";
					foreach ($z as $valor) {
						echo "<td align='center'>".$valor."</td>";
						$array[$a][$b]=$valor;
						$b++;
					}
				echo "<td><form method='post' action='modificar-usuario.php' align='center' name='formulario_usuario'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='mod'>";
				echo "<input name='accept' type='submit' value='M' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td><form method='post' action='script_baja.php' align='center' name='formulario_baja'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='baja'>";
				echo "<input name='accept' type='submit' value='X' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
				$a++;
				$b=0;
			}
			echo "</table>";
			echo "<br>";
			//Fin de tabla de usuarios
		
	}
	
	include "footer.php";
?>
	</body>
</html>