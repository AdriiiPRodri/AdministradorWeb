<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php

	if($administracion == 'Normal'){
		include "cabecera-u.php";
		
		$mod="SELECT * FROM usuarios WHERE ID_usuario="."'".$_COOKIE['nick']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<br><form method='post' action='script_modificar_datos.php' align='center' name='formulario_modificacion'>
				<STRONG>El ID del usuario no se puede modificar, en caso de necesitar modificarlo habria que eliminar al usuario y crearlo de nuevo.<br><br>";
				echo "<input name='id_mod' type='hidden' value='".$_COOKIE['nick']."'></input>
				<STRONG>Nombre_Completo:</STRONG>&nbsp;&nbsp;<input name='completo_mod' type='text' value='".$modif[1]."'><BR/><br>
				<STRONG>Contraseña:</STRONG>&nbsp;&nbsp;&nbsp;<input name='pass_mod' type='text' value='".$modif[2]."'><br/>
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
	}
		
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		//Consulta a la base de datos
		$mod="SELECT * FROM gestionabdera.usuarios WHERE ID_usuario="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		
		//Crearemos un formulario sobre el cual se modificara el usuario:
		echo "<br><form method='post' action='script_modificar.php' align='center' name='formulario_modificacion'>
		<STRONG>El ID del usuario no se puede modificar, en caso de necesitar modificarlo habria que eliminar al usuario y crearlo de nuevo.<br><br>";
		echo "<input name='id_mod' type='hidden' value='".$modif[0]."'></input>
		<STRONG>Nombre_Completo:</STRONG>&nbsp;&nbsp;<input name='completo_mod' type='text' value='".$modif[1]."'><BR/><br>
		<STRONG>Contraseña:</STRONG>&nbsp;&nbsp;&nbsp;<input name='pass_mod' type='text' value='".$modif[2]."'><br/>
		<p>Elige privilegio:&nbsp;&nbsp;
		<!--Usamos javascript en el onChange sin esto no funciona nuestro script-->
		<select name='Privilegios_mod' onChange='document.form.submit()'>";
		//Con esto marcaremos por defecto si el usuario es administrador o normal y a raiz de ahi lo modificaremos
		if ($modif[3]=="Administrador") {
			echo "<option value='Administrador'>Administrador</option>";
			echo "<option value='Normal'>Normal</option>";
		}
		if ($modif[3]=="Normal") {
			echo "<option value='Normal'>Normal</option>";
			echo "<option value='Administrador'>Administrador</option>";
		}
		echo "</select>
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
		<STRONG>Otros datos:</STRONG>&nbsp;&nbsp;&nbsp;<input name='otros_mod' type='text' value='".$modif[5]."'><br/><br>			<input name='accept' type='submit' value='Modificar'/>
		<input name='borrar' type='reset' value='Restaurar'>
		</form>";	
	}
		include "footer.php";
?>
	</body>
</html>