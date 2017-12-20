<html>
	<head>
	<?php include "head.php"; ?>
	</head>
	<body>	
	<?php include "comprobante.php";?>

<?php
	if($administracion == 'Administrador'){
		include "cabecera-a.php";
		
		echo "<div class='container contenedor'>";
		//Formulario de creacion de incidencias
		echo "<div class='col-sm-12 col-md-12 col-xl-12'><hr>
		
		<div class='hidden-xs col-md-3 col-sm-2 col-xl-3'>&nbsp;</div>
		
		<div class='col-xs-12 col-md-6 col-xl-6 col-sm-7 caja4'>";
		//Es un usuario con privilegio de "Administrador".
			//Formulario de creacion de usuario
			echo "<form method='post' action='script_alta.php' align='center' name='formulario_alta'>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 superior'><label name='id' class='superior'>ID_usuario:</label><input  class='campo' name='id' type='text'></div>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 superior'><label name='pass' class='superior'>Contraseña:</label><input  class='campo' name='pass' type='text'></div>
				<div class='margen-t-b'><label name='completo'>Nombre_Completo:</label><input name='completo' class='campo' type='text'></div>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Privilegios'>Elige privilegio:</label> 
				<!--Usamos javascript en el onChange sin esto no funciona nuestro script-->
				<select class='selectcaja' name='Privilegios' onChange='document.form.submit()'>
					<option value='Administrador'>Administrador</option>
					<option value='Normal'>Normal</option>
				</select></div>
				<div class='col-sm-6 col-md-6 col-xl-6 col-xs-6 margen-t-b'><label name='Departamento'>Elige el departamento:</label>";
				//Aqui vamos a poner una consulta que nos rellene de manera automatica la lista de Despartamentos
				$departamento="SELECT Nombre_departamento FROM departamento";
				$d=mysql_query($departamento, $conexion);
				echo "<select class='selectcaja' name='Departamento' onChange='document.form.submit()';>";
				while ($z = mysql_fetch_row ($d)) {	
					foreach ($z as $valor) {
						echo "<option value='".$valor."'>".$valor."</option>";
					}
				}				
				echo "</select></div>
				<div class='inferior'><label name='otros'>Otros datos:</label><textarea class='campo area' name='otros' type='text'></textarea></div>
				<div class='inferior'><input class='envio' name='accept' type='submit' value='Enviar'>
				<input class='envio' name='borrar' type='reset' value='Borrar'></div></div>
				</form></div></div></div>";
			//Introduccion de datos en la base de datos
		
	}
		include "footer.php";
?>
	</body>
</html>