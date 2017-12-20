<?php
include ("conexion.php");
//Comprobamos con isset que tengan valor ambas cookies y si es así que prosiga, en caso de no serlo acabara el script
if(isset($_COOKIE["nick"]) AND isset($_COOKIE["pass"])) {
	//Seleccionamos la base de datos sobre la que vamos a hacer la consulta
	mysql_select_db("gestionabdera", $conexion);
	//Comprobamos que la cookie a sido creada legitimamente y no con algun programa externo, para ello realizamos una consulta usando los valores de las cookies
	$result = mysql_query("SELECT * FROM Usuarios WHERE ID_usuario='".$_COOKIE["nick"]."' AND Contrasena='".$_COOKIE["pass"]."'");
	//Si se producen resultados, continuamos avanzando y ya nos mostrara el panel de administrador, en caso contrario pasamos al else
	if(mysql_fetch_array($result)) {
		//Control de las cookies, para saber que son del administrador
		$priv="SELECT Privilegios FROM Usuarios WHERE ID_usuario = '".$_COOKIE["nick"]."'";
		$privilegio=mysql_query($priv, $conexion);
		$privi=mysql_fetch_row($privilegio);
		$show=$privi[0];
		if ($show=="Administrador") {
			echo "Hi Admin";
			//Tabla de incidencias pendientes:
			//Empezamos realizando una consulta con la condicion de que la incidencia tiene que tener estado PENDIENTE
			$select = mysql_query("SELECT * FROM incidencias WHERE Estado='PENDIENTE'", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='12'><h3 align=center>Incidencias en proceso</h3></tr>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Incidencias'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th>".$valor."</th>";
				}
			}
			//Vamos a crear una columna para el boton de generar pdf, borrar y modificar
			echo "<th>Modificar</th>";
			echo "<th>Borrar</th>";
			echo "<th>Generar PDF</th>";
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
				echo "<td><form method='post' action='modificar_incidencia_form.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='mod'>";
				echo "<input name='accept' type='submit' value='M' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td><form method='post' action='script_borrar_incidencia.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='inci'>";
				echo "<input name='accept' type='submit' value='X' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td><form method='post' action='script_generar_pdf.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='id_incidencia'>";
				echo "<input name='accept' type='submit' value='PDF' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
				$a++;
				$b=0;
			}
			echo "</table>";
			//Fin de tabla de incidencias pendientes
			echo "<br>";
		
			//Tabla incidencias no corregidas:
			//Empezamos realizando una consulta con la condicion de que la incidencia tiene que tener estado NO CORREGIDO
			$select = mysql_query("SELECT * FROM incidencias WHERE Estado='NO CORREGIDO'", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='12'><h3 align=center>Incidencias no corregidas</h3>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Incidencias'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th>".$valor."</th>";
					}
			}
			//Vamos a crear una columna para el boton de generar pdf, borrar y modificar
			echo "<th>Modificar</th>";
			echo "<th>Borrar</th>";
			echo "<th>Generar PDF</th>";
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
				echo "<td><form method='post' action='modificar_incidencia_form.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='mod'>";
				echo "<input name='accept' type='submit' value='M' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td><form method='post' action='script_borrar_incidencia.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='inci'>";
				echo "<input name='accept' type='submit' value='X' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "<td><form method='post' action='script_generar_pdf.php' align='center' name='formulario_pdf'>";
				echo "<input type='hidden' value='".$array[$a][0]."' name='id_incidencia'>";
				echo "<input name='accept' type='submit' value='PDF' align='center'>";
				echo "</input>";
				echo "</form></td>";
				echo "</tr>";
				$a++;
				$b=0;
			}
			echo "</table>";
			//Fin tabla incidencias no corregidas
			echo "<br>";
			//Enlaces a los otros paneles
			//Enlace al panel de usuarios
			echo "<form method='post' action='crear-incidencia.php' align='center' name='formulario_admin_usuario'>";
			echo "<input name='accept' type='submit' value='Crear incidencia'>";
			echo "</input>";
			echo "</form>";
			//Enlace a gestion de dependencias y materiales
			echo "<form method='post' action='todas-incidencia.php' align='center' name='formulario_dependencias'>";
			echo "<input name='accept' type='submit' value='Ver todas las incidencias'>";
			echo "</input>";
			echo "</form>";
			//Boton de volver
			echo "<form method='post' action='admin.php' align='center' name='volver'>";
			echo "<input name='accept' type='submit' value='Volver'>";
			echo "</input><br><br>";
			echo "</form>";
			//Enlace desconexion con funcion de javascript, usamos el parametro onClick para ejecutar la funcion desconexion
			echo "<form method='post' action='logout.php' align='center' name='formulario_desconexion'>";
			echo "<input name='accept' type='submit' value='Desconexion'>";
			echo "</input>";
			echo "</form>";			
	}
		else {
			//Destruimos las cookies falsas.
			setcookie("nick","x",time()-3600);
			setcookie("pass","x",time()-3600);
			//Redirigimos al panel de login
			header('Location: login.php');
		}
	mysql_free_result($result);
	}
}
else {
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}
?>