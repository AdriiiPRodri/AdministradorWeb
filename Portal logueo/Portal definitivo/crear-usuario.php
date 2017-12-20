<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		//Es un usuario con privilegio de "Administrador".
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
			//Introduccion de datos en la base de datos
		
	}
		include "footer.php";
?>
	</body>
</html>