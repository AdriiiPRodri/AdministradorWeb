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
			$alta_crea="INSERT INTO gestionabdera.usuarios (ID_usuario,Nombre_completo,Contrasena,Privilegios,Departamento,Otros)
			VALUES ("."'".$_POST['id']."'".","."'".$_POST['completo']."'".","."'".$_POST['pass']."'".","."'".$_POST['Privilegios']."'".","."'".$_POST['Departamento']."'".","."'".$_POST['otros']."'".");";
			$alta = mysql_query ($alta_crea, $conexion);
			//Comprobacion de que realmente se he creado el usuario
			if ($alta) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='crear-usuario.php';
					}  setTimeout ('redirection()', 50);
					alert('Usuario creado correctamente');
				</script>";
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='crear-usuario.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo la creacion de usuario');
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