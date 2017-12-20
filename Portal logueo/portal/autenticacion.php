<?php 
   
include ("conexion.php"); 

//////////Evita ataques SQL Injection//////////
function quitar($mensaje) {
$mensaje = str_replace("<","<",$mensaje);
$mensaje = str_replace(">",">",$mensaje);
$mensaje = str_replace("\'","'",$mensaje);
$mensaje = str_replace('\"',"",$mensaje);
$mensaje = str_replace("\\\\","&#92",$mensaje);
return $mensaje;
} 
///////////////////////////////////////////////

/***Comprobacion de usuarios, con el comando trim eliminamos espacios en blanco introducidos antes del usuario y la contraseña.
	En caso de que el usuario deje los campos de usuario y contraseña en blanco,
	deberemos de avisarle de que no esta permitido el acceso con credenciales en blanco, esto lo haremos con el else ya que 
	aqui indicamos que no se permite cadenas vacias***/      
if(trim($_POST["auth_user"]) != "" && trim($_POST["auth_pass"]) != "") {
	$user=$_POST["auth_user"];
	$password=$_POST["auth_pass"];
	//Seleccionamos la base de datos
	mysql_select_db("gestionabdera", $conexion);
	//Consultamos a la tabla Usuarios la Contraseña cuando el usuario sea el introducido
	$result = mysql_query("SELECT Contrasena FROM Usuarios WHERE ID_usuario='".$user."'");
	//Hacemos la consulta he indicamos que coja las filas de la columna seleccionada
	if($row = mysql_fetch_row($result)) {
	//Coge la unica fila disponible en esta consulta de ahi el 0
	$pass=$row[0];
	//Comprobacion de la contraseña introducida con la que aparece en la base de datos
		if($pass == $password) {
			$priv="SELECT Privilegios FROM Usuarios WHERE ID_usuario = '".$user."'";
			$privilegio=mysql_query($priv, $conexion);
			$privi=mysql_fetch_row($privilegio);
			$show=$privi[0];
			if ($show=="Administrador") { //Es un usuario con privilegio de "Administrador".
				//Problema Principal
				//90 dias dura la cookie
				setcookie("usNick",$user,time()+7776000);
				setcookie("usPass",$pass,time()+7776000);	
				//Aqui tiene que ir un header que mande al panel de Administrador
				header('Location: admin.php');
			}
			if ($show=="Normal") { //Es un usuario con privilegio "básico".
				setcookie("identificador","0",0);
				//Aqui tiene que ir un header que mande al panel de Normal
				header('Location: normal.php');
			}	
		}
		else {
			//Ventana emergente con el error determinado y posterior redireccion a la pagina de index
			echo " <script type='text/javascript'>
			function redirection(){  
			window.location ='index.php';
			}  setTimeout ('redirection()', 50);
			alert('Contraseña Incorrecta');
			</script>";
		}
	}
	else {
		//Ventana emergente con el error determinado y posterior redireccion a la pagina de index
		echo " <script type='text/javascript'>
			function redirection(){  
			window.location ='index.php';
			}  setTimeout ('redirection()', 50);
			alert('Usuario Incorrecto');
			</script>";
	}
}
else {
	//Ventana emergente con el error determinado y posterior redireccion a la pagina de index
	echo " <script type='text/javascript'>
			function redirection(){  
			window.location ='index.php';
			}  setTimeout ('redirection()', 50);
			alert('Credenciales Incorrectos');
			</script>";;
}
?>