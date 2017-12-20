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
			$mod="SELECT * FROM materiales WHERE ID_material="."'".$_POST['mod']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara la dependencia:
			echo "<br><form method='post' action='script_modificar_material.php' align='center' name='formulario_modificacion_material'>
				<input name='material_mod' type='hidden' value='".$modif[0]."'></input>
				<STRONG>Nombre:</STRONG>&nbsp;&nbsp;<input name='desc_material_mod' type='text' value='".$modif[1]."'><BR/><br>
				<STRONG>Unidades totales:</STRONG>&nbsp;&nbsp;&nbsp;<input name='ubi_material_mod' type='text' value='".$modif[2]."'><br/><br>
				<STRONG>Tipo:</STRONG>
				<select name='tipo' onChange='document.form.submit()';>
					<option value='".$modif[3]."' checked='checked'>".$modif[3]."</option>
					<option value='TIC'>TIC</option>
					<option value='Mobiliario'>Mobiliario</option>
					<option value='Otros'>Otros</option>
				</select><br><br>
				<STRONG>Dependencia:</STRONG>";
				$dependencias="SELECT Nombre_dependencia FROM dependencias";
				$d=mysql_query($dependencias, $conexion);
				echo "<select name='Dependencia' onChange='document.form.submit()';><table>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select><br><br>
				<input name='accept' type='submit' value='Modificar'/>
				<input name='borrar' type='reset' value='Restaurar'>
				</form>";
				//Boton de volver
				echo "<form method='post' action='admin-materiales.php' align='center' name='volver'>";
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