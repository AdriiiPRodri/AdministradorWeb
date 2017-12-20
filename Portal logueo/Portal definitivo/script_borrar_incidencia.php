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
			//Al ser un administrador, este usuario podra borrar cualquier incidencia
			//Guardaremos una variable con el estado para saber a que tabla debemos redirigir
			$estado="SELECT Estado FROM incidencias WHERE N_incidencia='".$_POST['inci']."';";
			$esta=mysql_query($estado, $conexion);
			$estad=mysql_fetch_row($esta);
			//Eliminacion de la incidencia
			$borrar="DELETE FROM incidencias WHERE N_incidencia='".$_POST['inci']."';";
			$borrado=mysql_query ($borrar, $conexion);
			//Comprobacion de que realmente se ha borrado la incidencia
			if ($borrado) {
				if ($estad[0]=='NO CORREGIDO') {
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='no-corregidas.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
				if ($estad[0]=='PENDIENTE'){
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='pendientes.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
				if ($estad[0]=='CORREGIDO'){
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='corregidas.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='no-corregidas.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en el borrado de incidencia');
				</script>";
			}
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