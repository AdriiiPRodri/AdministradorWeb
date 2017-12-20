<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		$select1 = mysql_query("SELECT * FROM contiene", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='3'><h3 align=center>Materiales--Dependencias</h3></tr>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos1=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'contiene'",$conexion);
			while($v1=mysql_fetch_row($campos1)){
				foreach($v1 as $valor1) {
					echo "<th>".$valor1."</th>";
					}
			}	
			while ($z2 = mysql_fetch_row ($select1)) {
				echo "<tr>";
					foreach ($z2 as $valor2) {
						echo "<td align='center'>".$valor2."</td>";
					}	
			}
			echo "</table><br><br>";
		
	}	
		include "footer.php";
?>
	</body>
</html>