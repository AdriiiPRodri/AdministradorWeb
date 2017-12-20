<?php
include ("conexion.php");
//Comprobamos con isset que tengan valor ambas cookies y si es así que prosiga, en caso de no serlo acabara el script
if(isset($_COOKIE["nick"]) AND isset($_COOKIE["pass"])) {
	//Seleccionamos la base de datos sobre la que vamos a hacer la consulta
	mysql_select_db("gestionabdera", $conexion);
	//Comprobamos que la cookie a sido creada legitimamente y no con algun programa externo, para ello realizamos una consulta usando los valores de las cookies
	$result = mysql_query("SELECT * FROM Usuarios WHERE ID_usuario='".$_COOKIE["nick"]."' AND Contrasena='".$_COOKIE["pass"]."'");
	if(mysql_fetch_array($result)) {
		//Para pode poner de manera automatica el numero de incidencia que corresponde, necesitamos saber cual a sido la ultima (ORDER BY N_incidencia LIMIT 1)
		//incidencia puesto y es esta sumarle 1 de esta manera conseguiremos que se pnga de manera automatica y sin que se repitan nunca.
		$consulta=mysql_query("SELECT N_incidencia FROM gestionabdera.incidencias ORDER BY N_incidencia DESC LIMIT 1");
		$consul=mysql_fetch_row($consulta);
		$consultamas=$consul[0]+1;
		//Tanto la el numero de incidencia como el usuario que la ha puesto y el departamento quedaran registrados de manera automatica, para ello nos valemos del select 
		//anterior y para el usuario, nos valemos de la cookie que contiene su nombre
		//Puesto que el departamento ha de colocarse de manera automatica, para ello vamos a hacer una consulta dependiendo del usuario con el que
		//nos logueemos
		//Tambien debemos de insertar la fecha y hora de manera automatica para ello usaremos lo siguiente: $fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
		$departamento="SELECT Departamento FROM usuarios WHERE ID_usuario='".$_COOKIE['nick']."'";
		$d=mysql_query($departamento, $conexion);
		$depart=mysql_fetch_row($d);
		$fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
		$crea_incidencia="INSERT INTO incidencias (N_incidencia,Descripcion,Dependencia,Fecha_hora,Tipo,Usuario,Comentario)
		VALUES (".$consultamas.","."'".$_POST['descripcion']."',"."'".$_POST['Dependencia']."'"." ,"."'".$fecha."',"."'".$_POST['tipo']."','".$_COOKIE['nick']."','".$_POST['coment']."');";
		$creaincidencia = mysql_query ($crea_incidencia, $conexion);
		//Puesto que este panel lo van a usar tanto administradores como usuarios normales, necesitamos un mecanismo de redireccion que redirija en
		//funcion del tipo de usuario que sea, esto lo haremos con un if y las cookies para realizar una consulta y saber los privilegios del usuario
		//Comprobacion de que realmente se he creado la incidencia
		$priv="SELECT Privilegios FROM Usuarios WHERE ID_usuario = '".$_COOKIE["nick"]."'";
		$privilegio=mysql_query($priv, $conexion);
		$privi=mysql_fetch_row($privilegio);
		$show=$privi[0];
		if ($show=="Administrador") {
			if ($creaincidencia) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-incidencias.php';
					}  setTimeout ('redirection()', 50);
					alert('Incidencia creada correctamente');
				</script>";					
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='admin-incidencias.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en la creacion de incidencia');
				</script>";
			}
		}else{
			if ($creaincidencia) {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='normal.php';
					}  setTimeout ('redirection()', 50);
					alert('Incidencia creada correctamente');
				</script>";
			}
			else {
				echo " <script type='text/javascript'>
					function redirection(){  
					window.location ='normal.php';
					}  setTimeout ('redirection()', 50);
					alert('Fallo en la creacion de incidencia');
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