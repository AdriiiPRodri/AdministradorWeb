<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php

	if($administracion == 'Normal'){
		include "cabecera-u.php";
		
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
		$mod="SELECT * FROM usuarios WHERE ID_usuario="."'".$_COOKIE['nick']."';";
			$modi=mysql_query($mod, $conexion);
			$modif=mysql_fetch_row($modi);
			//Crearemos un formulario sobre el cual se modificara el usuario:
			echo "<form method='post' action='script_modificar_datos.php' align='center' name='formulario_modificacion'>";
				echo "<input name='id_mod' type='hidden' value='".$_COOKIE['nick']."'></input>
				<div><label name='completo_mod'>Nombre_Completo:</label><input class='campo' name='completo_mod' type='text' value='".$modif[1]."'></div>
				<div><label name='pass-mod'>Contraseña:</label><input class='campo' name='pass_mod' type='text' value='".$modif[2]."'></div>
				<div><label name='Departamento_mod'>Elige el departamento:</label>";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select class='selectcaja' name='Departamento_mod' onChange='document.form.submit()';><table>";
				echo "<option value='".$modif[4]."'>".$modif[4]."</option><BR/><br>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select></div>
				<br><label name='otros_mod'>Otros datos:</label><textarea class='campo area' name='otros_mod' value='".$modif[5]."'></textarea>
				<div><input class='envio' name='accept' type='submit' value='Modificar'/>
				<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
				<div class='inferior'><h5>El ID del usuario no se puede modificar, en caso de necesitar modificarlo habria que eliminar al usuario y crearlo de nuevo.</h5></div>
				</form></div></div>";	
	}
		
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		echo "<div class='container contenedor'>";
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
		//Consulta a la base de datos
		$mod="SELECT * FROM gestionabdera.usuarios WHERE ID_usuario="."'".$_POST['mod']."';";
		$modi=mysql_query($mod, $conexion);
		$modif=mysql_fetch_row($modi);
		
		//Crearemos un formulario sobre el cual se modificara el usuario:
		echo "<form method='post' action='script_modificar.php' align='center' name='formulario_modificacion'>";
		echo "<input name='id_mod' type='hidden' value='".$modif[0]."'></input>
		<div class='superior'><label name='completo_mod'>Nombre_Completo:</label><input class='campo' name='completo_mod' type='text' value='".$modif[1]."'></div>
		<div class='margen-t-b'><label name='pass_mod'>Contraseña:</label><input class='campo' name='pass_mod' type='text' value='".$modif[2]."'></div>
		<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Privilegios_mod'>Elige privilegio:</label>
		<!--Usamos javascript en el onChange sin esto no funciona nuestro script-->
		<select class='selectcaja' name='Privilegios_mod' onChange='document.form.submit()'>";
		//Con esto marcaremos por defecto si el usuario es administrador o normal y a raiz de ahi lo modificaremos
		if ($modif[3]=="Administrador") {
			echo "<option value='Administrador'>Administrador</option>";
			echo "<option value='Normal'>Normal</option>";
		}
		if ($modif[3]=="Normal") {
			echo "<option value='Normal'>Normal</option>";
			echo "<option value='Administrador'>Administrador</option>";
		}
		echo "</select></div>
		<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Departamento_mod'>Elige el departamento:</label>";
		//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
		$departamento="SELECT Nombre_departamento FROM departamento";
		$d=mysql_query($departamento, $conexion);
		echo "<select class='selectcaja' name='Departamento_mod' onChange='document.form.submit()';><table>";
		echo "<option value='".$modif[4]."'>".$modif[4]."</option><BR/><br>";
		while ($z = mysql_fetch_row ($d)) {	
			foreach ($z as $valor) {
				echo "<option value='".$valor."'>".$valor."</option>";
			}
		}				
		echo "</select></div>
		<div class='margen-t-b'><label name='otros_mod'>Otros datos:</label><textarea class='campo area' name='otros_mod' type='text' value='".$modif[5]."'></textarea></div>
		<div class='margen-t-b'><input class='envio' name='accept' type='submit' value='Modificar'/>
		<input class='envio' name='borrar' type='reset' value='Restaurar'></div>
		</form>
		<div class='inferior'><h5>El ID del usuario no se puede modificar, en caso de necesitar modificarlo habria que eliminar al usuario y crearlo de nuevo.</h5></div></div></div></div>";	
	}
		include "footer.php";
?>
	</body>
</html>