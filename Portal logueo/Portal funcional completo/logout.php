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
			$fecha_salida=strftime( "%Y-%m-%d-%H-%M-%S", time() );
			//Para pode poner de manera automatica el numero de entrada que corresponde, necesitamos saber cual a sido la ultima (ORDER BY N_incidencia LIMIT 1)
			// y sumarle 1 de esta manera conseguiremos que se pnga de manera automatica y sin que se repitan nunca.
			$consulta=mysql_query("SELECT N_entrada FROM entradas_sistema WHERE Usuario='".$_COOKIE['nick']."' ORDER BY N_entrada DESC LIMIT 1");
			$consul=mysql_fetch_row($consulta);
			$salid="UPDATE entradas_sistema SET F_salida='".$fecha_salida."' WHERE N_entrada='".$consul[0]."'";
			mysql_query($salid, $conexion);	
			//Destruimos las cookies falsas.
			setcookie('nick','x',time()-3600);
			setcookie('pass','x',time()-3600);
			//Redirigimos al panel de login
			header('Location: login.php');
		}
	}
	else{
		header('Location: login.php');
	}
?>