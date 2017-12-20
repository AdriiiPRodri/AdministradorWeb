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
			$update="UPDATE Usuarios SET Nombre_completo='".$_POST['completo_mod']."',Contrasena='".$_POST['pass_mod']."',Departamento='".$_POST['Departamento_mod']."',Otros='".$_POST['otros_mod']."' WHERE ID_usuario="."'".$_POST['id_mod']."';";
			$updater=mysql_query ($update, $conexion);
			//Comprobacion de que realmente se ha modificado el usuario
			if ($updater) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='modificar-usuario.php';
					}  setTimeout ('redirection()', 50);
					alert('Usuario modificado correctamente, tendras que loguearte de nuevo.');
				</script>";
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='modificar-usuario.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en modificacion del usuario');
				</script>";
			}
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
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}
?>