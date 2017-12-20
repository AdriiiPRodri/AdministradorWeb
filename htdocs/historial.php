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
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><h3>Entradas al Sistema</h3></div><hr>";
		//Tabla de usuarios:
			$select = mysql_query("SELECT * FROM entradas_sistema", $conexion);
			//Generamos la tabla:
			echo "<table class='tabla'>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'entradas_sistema'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th class='atributos'>".$valor."</th>";
					}
			}
			echo "</tr>";
			//Datos de la tabla de usuarios:
			while ($z = mysql_fetch_row ($select)) {
				echo "<tr>";
					foreach ($z as $valor) {
						echo "<td class='valores'>".$valor."</td>";
					}
				echo "</tr>";
			}
			echo "</table></div></div>";
			//Fin de tabla de usuarios
		
	}
	
	include "footer.php";
?>
	</body>
</html>