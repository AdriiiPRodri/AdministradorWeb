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
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><h3>Usuarios Eliminados</h3></div><hr>";
		//Tabla de historico de usuarios:
		$select = mysql_query("SELECT * FROM historico_usuarios", $conexion);
		//Generamos la tabla:
		echo "<table class='tabla'>";
		//Abrimos un tr para poner los nombres de las columnas:
		echo "<tr>";
		//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
		$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'historico_usuarios'",$conexion);
		while($v=mysql_fetch_row($campos)){
			foreach($v as $valor) {
				echo "<th class='atributos'>".$valor."</th>";
			}
		}
		echo "</tr>";
		//Datos de la tabla de historico de usuarios:
		while ($z = mysql_fetch_row ($select)) {
			echo "<tr>";
				foreach ($z as $valor) {
					echo "<td class='valores'>".$valor."</td>";
				}
			echo "</tr>";
		}
		echo "</table></div></div>";
		echo "<br>";
		//Fin de tabla de historico de usuarios	
	}
	
	include "footer.php";
?>
	</body>
</html>