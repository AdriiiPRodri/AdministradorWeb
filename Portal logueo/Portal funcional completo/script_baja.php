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
			//Para poder insertar el usuario que vamos a borrar en la tabla de historico de usuarios, primero debemos de conocer todos sus atributos:
			$busq="SELECT * FROM gestionabdera.usuarios WHERE ID_usuario="."'".$_POST['baja']."';";
			$busqu=mysql_query($busq, $conexion);
			$busque=mysql_fetch_row($busqu);
			//Ahora insertamos los datos acorde con los valores que nos devuelve la sentencia anterior
			$insercion="INSERT INTO historico_usuarios (ID_usuario,Nombre_completo,Contrasena,Privilegios,Departamento,Otros)
			VALUES ("."'".$_POST['baja']."'".","."'".$busque[1]."'".","."'".$busque[2]."'".","."'".$busque[3]."'".","."'".$busque[4]."'".","."'".$busque[5]."'".");";
			//Ejecucion
			mysql_query($insercion, $conexion);
			//Ahora procedemos a eliminar el usuario
			//Eliminacion del usuario
			$baja="DELETE FROM gestionabdera.usuarios WHERE ID_usuario="."'".$_POST['baja']."';";
			$bajad=mysql_query ($baja, $conexion);
			//Comprobacion de que realmente se ha borrado el usuario
			if ($bajad) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-usuarios.php';
					}  setTimeout ('redirection()', 50);
					alert('Usuario borrado correctamente');
				</script>";
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-usuarios.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en el borrado de usuario');
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
		header('Location: login.php');
	}
	mysql_free_result($result);
}
else {
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}
?>