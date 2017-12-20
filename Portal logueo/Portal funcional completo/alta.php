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
			//Formulario de creacion de usuario
			echo "<br><form method='post' action='script_alta.php' align='center' name='formulario_alta'>
				<STRONG>ID_usuario:</STRONG>&nbsp;&nbsp;<input name='id' type='text'><BR/><br>
				<STRONG>Nombre_Completo:</STRONG>&nbsp;&nbsp;<input name='completo' type='text'><BR/><br>
				<STRONG>Contraseña:</STRONG>&nbsp;&nbsp;&nbsp;<input name='pass' type='text'><br/><br>
				<p>Elige privilegio: 
				<!--Usamos javascript en el onChange sin esto no funciona nuestro script-->
				<select name='Privilegios' onChange='document.form.submit()'>
					<option value='Administrador'>Administrador</option>
					<option value='Normal'>Normal</option>
				</select><br>
				<p>Elige el departamento: ";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select name='Departamento' onChange='document.form.submit()';>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select><br><br>
				<STRONG>Otros datos:</STRONG>&nbsp;&nbsp;&nbsp;<input name='otros' type='text'><br/><br>
				<input name='accept' type='submit' value='Enviar'>
				<input name='borrar' type='reset' value='Borrar'>
				</form>";
			//Boton de volver
			echo "<form method='post' action='admin-usuarios.php' align='center' name='volver'>";
			echo "<input name='accept' type='submit' value='Volver'>";
			echo "</input><br><br>";
			echo "</form>";
			//Enlace desconexion con funcion de javascript, usamos el parametro onClick para ejecutar la funcion desconexion
			echo "<form method='post' action='logout.php' align='center' name='formulario_desconexion'>";
			echo "<input name='accept' type='submit' value='Desconexion'>";
			echo "</input>";
			echo "</form>";	
			//Introduccion de datos en la base de datos
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