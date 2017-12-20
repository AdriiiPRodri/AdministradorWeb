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
		if ($show=="Administrador") { //Es un usuario con privilegio de "Administrador".
			echo "Hi Admin";
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
			//Boton de volver
			echo "<form method='post' action='admin-usuarios.php' align='center' name='volver'>";
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
	}
	else {
		header('Location: login.php');
	}
	mysql_free_result($result);
}
else {
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}
?>