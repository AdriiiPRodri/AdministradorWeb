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
			$mod="SELECT * FROM usuarios WHERE ID_usuario="."'".$_POST['idusuario']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<br><form method='post' action='script_modificar_datos.php' align='center' name='formulario_modificacion'>
				<STRONG>El ID del usuario no se puede modificar, en caso de necesitar modificarlo habria que eliminar al usuario y crearlo de nuevo.<br><br>";
				echo "<input name='id_mod' type='hidden' value='".$modif[0]."'></input>
				<STRONG>Nombre_Completo:</STRONG>&nbsp;&nbsp;<input name='completo_mod' type='text' value='".$modif[1]."'><BR/><br>
				<STRONG>Contrase�a:</STRONG>&nbsp;&nbsp;&nbsp;<input name='pass_mod' type='text' value='".$modif[2]."'><br/>
				<p>Elige el departamento:&nbsp;&nbsp;";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select name='Departamento_mod' onChange='document.form.submit()';><table>";
				echo "<option value='".$modif[4]."'>".$modif[4]."</option><BR/><br>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select><br><br>
				<STRONG>Otros datos:</STRONG>&nbsp;&nbsp;&nbsp;<input name='otros_mod' type='text' value='".$modif[5]."'><br/><br>
				<input name='accept' type='submit' value='Modificar'/>
				<input name='borrar' type='reset' value='Restaurar'>
				</form>";
				//Boton de volver
				echo "<form method='post' action='normal.php' align='center' name='volver'>";
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