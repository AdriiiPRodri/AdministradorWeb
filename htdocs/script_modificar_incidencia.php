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
			$update="UPDATE incidencias SET Descripcion='".$_POST['descripcion_mod']."',Dependencia='".$_POST['Dependencia_mod']."',Estado='".$_POST['estado']."',Tipo='".$_POST['tipo']."',Comentario='".$_POST['coment_mod']."' WHERE N_incidencia='".$_POST['N_incidencia']."';";
			$updater=mysql_query ($update, $conexion);
			//Si el estado es cambia a CORREGIDO, deberemos de insertar la fecha de correcion automaticamente, esto lo haremos con un if:
			$fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
			if ($_POST['estado']=='CORREGIDO'){
				$correccion="UPDATE incidencias SET Fecha_correccion='".$fecha."' WHERE N_incidencia='".$_POST['N_incidencia']."';";
				mysql_query($correccion, $conexion);
			}
			//Comprobacion de que realmente se ha modificado la incidencia
			if ($updater) {
				if ($_POST['estado']=='NO CORREGIDO') {
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='no-corregidas.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
				if ($_POST['estado']=='PENDIENTE'){
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='pendientes.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
				if ($_POST['estado']=='CORREGIDO'){
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
					alert('Fallo en la modificacion de la incidencia');
				</script>";
			}
		}
		else {
			$update="UPDATE incidencias SET Descripcion='".$_POST['descripcion_mod']."',Dependencia='".$_POST['Dependencia_mod']."',Tipo='".$_POST['tipo']."',Comentario='".$_POST['coment_mod']."' WHERE Usuario="."'".$_COOKIE['nick']."' AND N_incidencia='".$_POST['N_incidencia']."';";
			$updating=mysql_query ($update, $conexion);
			//El usuario normal no podra cambiar el estado de la incidencia
				if ($updating) {
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='no-corregidas.php';
						}  setTimeout ('redirection()', 50);
						alert('Incidencia modificada correctamente');
					</script>";
				}
				else {
					echo " <script type='text/javascript'>
						function redirection(){  
						window.location ='no-corregidas.php';
						}  setTimeout ('redirection()', 50);
						alert('Fallo en la modificacion de la incidencia');
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