<?php
include ("conexion.php");
//Comprobamos con isset que tengan valor ambas cookies y si es as� que prosiga, en caso de no serlo acabara el script
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
			//Al ser un administrador, este usuario podra borrar cualquier incidencia
			//Eliminacion de la incidencia
			$borrar="DELETE FROM incidencias WHERE N_incidencia='".$_POST['inci']."';";
			$borrado=mysql_query ($borrar, $conexion);
			//Comprobacion de que realmente se ha borrado la incidencia
			if ($borrado) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-incidencias.php';
					}  setTimeout ('redirection()', 50);
					alert('Incidencia borrada correctamente');
				</script>";
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-incidencias.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en el borrado de incidencia');
				</script>";
			}
		}
		else {
			//Al ser un usuario normal, este usuario solo podra borrar sus incidencias y ademas solo las que aun no esten corregidas
			//Eliminacion de la incidencia
			echo "<strong>Los usuarios no administradores solo podran borrar sus propias incidencias con el estado NO CORREGIDO</strong>";
			$borrar="DELETE FROM incidencias WHERE N_incidencia='".$_POST['inci']."' AND Usuario='".$_COOKIE['nick']."' AND Estado='NO CORREGIDO'";
			$borrado=mysql_query ($borrar, $conexion);
			header('Location: borrar-incidencia.php');
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