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
		//Formulario de creacion de incidencias
			echo "<br><form method='post' action='script_crear_departamento.php' align='center' name='formulario_depart'>
				<STRONG>Nombre departamento:</STRONG>&nbsp;&nbsp;<input name='nombre_d' type='text'><BR/><br>
				<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_d' type='text'><BR/><br>
				<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;<input name='ubicacion_d' type='text'><BR/><br>				
				<input name='accept' type='submit' value='Enviar'>
				<input name='borrar' type='reset' value='Borrar'><br><br>
				</form>";
				//Boton de volver
				echo "<form method='post' action='admin-depmat.php' align='center' name='volver'>";
				echo "<input name='accept' type='submit' value='Volver'>";
				echo "</input><br><br>";
				echo "</form>";
				//Enlace desconexion con funcion de javascript, usamos el parametro onClick para ejecutar la funcion desconexion
				echo "<form method='post' action='logout.php' align='center' name='formulario_desconexion'>";
				echo "<input name='accept' type='submit' value='Desconexion'>";
				echo "</input>";
				echo "</form>";			
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