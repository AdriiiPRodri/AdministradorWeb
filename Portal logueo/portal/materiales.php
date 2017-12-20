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
				<div class="col-xs-4 col-sm-4 caja5" onclick="abrir('1')">Materiales</div>
				<div class="col-xs-4 col-sm-4 caja5" onclick="abrir('2')">Modificar dependecias</div>
				<div class="col-xs-4 col-sm-4 caja5" onclick="abrir('3')">Modificar materiales</div>
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
		
		
		</div>
		
		<?php
			include 'footer.php';
		?>
	
	</body>
</html>