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
		//Formulario de creacion de dependencias
			echo "<br><form method='post' action='script_crear_dependencia.php' align='center' name='formulario_depen'>
				<STRONG>Nombre dependencia:</STRONG>&nbsp;&nbsp;<input name='nombre_de' type='text'><BR/><br>
				<STRONG>Descripcion:</STRONG>&nbsp;&nbsp;<input name='descripcion_de' type='text'><BR/><br>
				<STRONG>Ubicacion:</STRONG>&nbsp;&nbsp;<input name='ubicacion_de' type='text'><BR/><br>				
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
				<input name='accept' type='submit' value='Enviar'>
				<input name='borrar' type='reset' value='Borrar'><br><br>
				</form>";
				//Boton de volver
				echo "<form method='post' action='admin-depmat.php' align='center' name='volver'>";
				echo "<input name='accept' type='submit' value='Volver'>";
				echo "</input><br><br>";
				echo "</form>";
				//Enlace desconexion 
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