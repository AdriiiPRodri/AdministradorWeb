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
			$select = mysql_query("SELECT * FROM entradas_sistema", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='6'><h3 align=center>Entradas al sistema</h3></tr>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'entradas_sistema'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th>".$valor."</th>";
					}
			}
			echo "</tr>";
			//Datos de la tabla de usuarios:
			while ($z = mysql_fetch_row ($select)) {
				echo "<tr>";
					foreach ($z as $valor) {
						echo "<td align='center'>".$valor."</td>";
					}
				echo "</tr>";
			}
			echo "</table>";
			echo "<br>";
			//Fin de tabla de usuarios
		
	}
	
	include "footer.php";
?>
	</body>
</html>