<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php		
		if($administracion == 'Normal'){
		include "cabecera-u.php";
		
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>";
		//Tabla de incidencias del propio usuario:
		$select = mysql_query("SELECT * FROM incidencias WHERE Usuario='".$_COOKIE['nick']."' AND Estado='PENDIENTE'", $conexion);
		//Ponemos una cabecera:
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><h3>Pendientes</h3></div><hr>";
		//Generamos la tabla:
		echo "<table class='tabla'>";
		//Abrimos un tr para poner los nombres de las columnas:
		echo "<tr>";
		//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
		$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'incidencias'",$conexion);
		while($v=mysql_fetch_row($campos)){
			foreach($v as $valor) {
				if ($valor!='Fecha_correccion' AND $valor!='Estado' AND $valor!='N_incidencia' AND $valor!='Usuario') {
					echo "<th class='atributos'>".$valor."</th>";
				}
			}
		}
		//Vamos a crear una columna para el boton de borrar y modificar
		echo "<th class='atributos'>Generar PDF</th>";
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
					$array[$a][$b]=$valor;
					if ($valor!='' AND $valor!='PENDIENTE' AND $b!=0 AND $valor!=$_COOKIE['nick']) {						
						echo "<th class='valores'>".$valor."</th>";						
					}
					$b++;
				}
			if ($array[$a][4]=='PENDIENTE' AND $array[$a][6]=$_COOKIE['nick']){
				echo "<td class='valores'><form method='post' action='script_generar_pdf.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='id_incidencia'>";
				echo "<input class='botones' name='accept' type='submit' value='&#xf1c1;' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
			}
			$a++;
			$b=0;
		}
		echo "</table></div></div>";
	}
	
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><h3>Pendientes</h3></div><hr>";
		//Tabla incidencias no corregidas:
			//Empezamos realizando una consulta con la condicion de que la incidencia tiene que tener estado NO CORREGIDO
			$select = mysql_query("SELECT * FROM incidencias WHERE Estado='PENDIENTE'", $conexion);
			//Generamos la tabla:
			echo "<table class='tabla'>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Incidencias'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					if ($valor!='Fecha_correccion' AND $valor!='Estado') {
						echo "<th class='atributos'>".$valor."</th>";
					}
				}
			}
			//Vamos a crear una columna para el boton de generar pdf, borrar y modificar
			echo "<th class='atributos'>Modificar</th>";
			echo "<th class='atributos'>Borrar</th>";
			echo "<th class='atributos'>Generar PDF</th>";
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
						if ($valor!='' AND $valor!='PENDIENTE') {						
							echo "<td class='valores'>".$valor."</td>";						
						}
						$array[$a][$b]=$valor;
						$b++;
					}
				echo "<td class='valores'><form method='post' action='modificar-incidencia.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='mod'>";
				echo "<input name='accept' type='submit' value='M' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td class='valores'><form method='post' action='script_borrar_incidencia.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='inci'>";
				echo "<input name='accept' type='submit' value='X' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td class='valores'><form method='post' action='script_generar_pdf.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='id_incidencia'>";
				echo "<input name='accept' type='submit' value='PDF' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
				$a++;
				$b=0;
			}
			echo "</table></div></div>";
			//Fin tabla incidencias no corregidas
	}
	
	include "footer.php";
?>
	</body>
</html>