<html>
	<head>
		<?php
			include 'head.php';
		?>
	</head>
	
	<body class="body">
		<?php
			include 'cabecera2.php';
		?>
	
		<div class="container contenedor">
			<!--Contenido pagina principal, esta estará antes del login para que puedan acceder a las distintas herramientas los usuarios hasta que se cree un login único, aquí habrá una breve descripción, si encuentro el código en internet aquí el texto irá cambiando por lo que vayamos a poner en cada caja-->
			<div class="col-sm-12 col-xs-12">
				<div class="col-xs-3 col-sm-3 caja5" onclick="abrir('1')">Nueva incidencia</div>
				<div class="col-xs-3 col-sm-3 caja5" onclick="abrir('2')">Buscar incidencia</div>
				<div class="col-xs-3 col-sm-3 caja5" onclick="abrir('3')">Modificar incidencia</div>
				<div class="col-xs-3 col-sm-3 caja5" onclick="abrir('4')">Eliminar incidencia</div>
			</div>
			<hr>
			<div class="col-sm-12">
				<div class="col-sm-12 oculta" id="1">
					<form method="post" action="#">
						<!--Numero incidencia(automatica) - Fecha(automatica) -->
						<div class="col-sm-4"><label>Dependencia</label><input class="campo"></div>
						<div class="col-sm-4"><label>Material</label><input class="campo"></div>
						<div class="col-sm-4"><label>Tipo</label><input class="campo"></div>
						<div type="textarea" class="col-sm-12"><label>Comentario</label><input class="campo" style="width: 100%;"></div>
						<div class="col-sm-12"><input type="submit" value="Publicar incidencia" class="campo envio"></div>
					</form>
				</div>
				<div class="col-sm-12 oculta" id="2">
					<div class="col-sm-3 ">
						<select>
							<option value="usuario" selected="selected">Usuario(Predeterminado)</option>
							<option value="numero">Numero incidencia</option>
							<option value="fecha">Fecha</option>
							<option value="dependencia">Dependencia</option>
							<option value="material">Material</option>
							<option value="tipo">Tipo</option>
							<option value="estado">Estado</option>
						</select>
					</div>
					<div class="col-sm-9 ">
						<input class="campo"></input>
					</div>
					<div class="col-sm-12"><input type="submit" value="Iniciar busqueda" class="campo envio"></div>
				</div>
				<div class="col-sm-12 oculta" id="3">
					SELECCION POR ID -> FILTRA POR Usuario -> MUESTRA Dependencia - Material - Tipo - Comentario
				</div>
				<div class="col-sm-12 oculta" id="4">
					Usuario
				</div>
		</div>
		<div>
			<?php
				/*include ("conexion.php");
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
					
					if ($show=="Administrador") {
						echo "Hi Admin";
					//Tabla de incidencias pendientes:
					//Empezamos realizando una consulta con la condicion de que la incidencia tiene que tener estado PENDIENTE
					$select = mysql_query("SELECT * FROM incidencias WHERE Estado='PENDIENTE'", $conexion);
					//Generamos la caja que contendrá toda la información:
					echo "<table border=1 align=center>";
					echo "<div class='col-sm-12'>"
					//Ponemos una cabecera:
					echo "<tr><td colspan='9'><h3 align=center>Incidencias en proceso</h3></tr>";
					echo "<div class='col-sm-12'><h3 align='center'>Incidencias en proceso</h3></div>"
					//Abrimos un tr para poner los nombres de las columnas:
					echo "<tr>";
					//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
					$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Incidencias'",$conexion);
					while($v=mysql_fetch_row($campos)){
						foreach($v as $valor) {
							echo "<th>".$valor."</th>";
						}
					}
					echo "</tr>";
		
					//Valores de la tabla de incidencias con estado PENDIENTE
					while ($z = mysql_fetch_row ($select)) {
						echo "<tr>";
						foreach ($z as $valor) {
							echo "<td align='center'>".$valor."</td>";
						}
					echo "</tr>";
					}
					echo "</table>";
					//Fin de tabla de incidencias pendientes
					echo "<br>";
		
			//Tabla incidencias no corregidas:
			//Empezamos realizando una consulta con la condicion de que la incidencia tiene que tener estado NO CORREGIDO
			$select = mysql_query("SELECT * FROM incidencias WHERE Estado='NO CORREGIDO'", $conexion);
			//Generamos la tabla:
			echo "<table border=1 align=center>";
			//Ponemos una cabecera:
			echo "<tr><td colspan='9'><h3 align=center>Incidencias no corregidas</h3>";
			//Abrimos un tr para poner los nombres de las columnas:
			echo "<tr>";
			//La siguiente instruccion y el siguiente bucle es para mostrar los nombres de los atributos al comienzo de la tabla
			$campos=mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'gestionabdera' AND TABLE_NAME = 'Incidencias'",$conexion);
			while($v=mysql_fetch_row($campos)){
				foreach($v as $valor) {
					echo "<th>".$valor."</th>";
					}
			}
			//Valores de la tabla de incidencias con estado NO CORREGIDO
			while ($z = mysql_fetch_row ($select)) {
				echo "<tr>";
					foreach ($z as $valor) {
						echo "<td align='center'>".$valor."</td>";
					}
				echo "</tr>";
			}
			echo "</table>";
			//Fin tabla incidencias no corregidas
			echo "<br>";
			//Enlaces a los otros paneles
			//Enlace al panel de usuarios
			echo "<form method='post' action='crear-incidencia.php' align='center' name='formulario_admin_usuario'>";
			echo "<input name='accept' type='submit' value='Crear incidencia'>";
			echo "</input>";
			echo "</form>";
			//Enlace a gestion de incidencias
			echo "<form method='post' action='borrar-incidencia.php' align='center' name='formulario_incidencias'>";
			echo "<input name='accept' type='submit' value='Borrar incidencia'>";
			echo "</input>";
			echo "</form>";
			//Enlace a gestion de dependencias y materiales
			echo "<form method='post' action='modificar-incidencia.php' align='center' name='formulario_dependencias'>";
			echo "<input name='accept' type='submit' value='Modificar incidencia'>";
			echo "</input>";
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
	mysql_free_result($result);
	}
}
else {
	//Si no existen las cookies, el usuario es redirigido al panel de login
	header('Location: login.php');
}*/
?>
		</div>
		
		<?php
			include 'footer.php';
		?>
	
	</body>
</html>