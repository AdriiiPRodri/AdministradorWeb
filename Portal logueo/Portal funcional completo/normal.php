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
		//Vamos a la pestaña de creacion
		echo "<br><br><br><form name='formulario' align='center' action='crear-incidencia.php' method='post' >";
		echo "<input name='accept' type='submit' value='Poner incidencia'>";
		echo "</input>";
		echo "</form>";
		//Vamos a la pestaña de sus propias incidencias
		echo "<form name='formulario' align='center' action='ver_incidencias_normal.php' method='post' >";
		echo "<input type='hidden' value='".$_COOKIE['nick']."' name='idusuario'>";
		echo "<input name='accept' type='submit' value='Ver mis incidencias'>";
		echo "</input>";
		echo "</form>";
		//Modificar mis datos de usuario
		echo "<form name='formulario' align='center' action='modificar_datos.php' method='post' >";
		echo "<input type='hidden' value='".$_COOKIE['nick']."' name='idusuario'>";
		echo "<input name='accept' type='submit' value='Modificar mis datos de usuario'>";
		echo "</input>";
		echo "</form>";
		//Enlace desconexion con funcion de javascript, usamos el parametro onClick para ejecutar la funcion desconexion
		echo "<form method='post' action='logout.php' align='center' name='formulario_desconexion'>";
		echo "<input name='accept' type='submit' value='Desconexion'>";
		echo "</input>";
		echo "</form>";	
}else {
	header('Location: login.php');
}
	mysql_free_result($result);
}
else {
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}
?>