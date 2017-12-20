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
			
			<div class="hidden-xs">
				<img class="slider" src="images/slider.png">
			</div>
			
			<div class="col-sm-9">
			<hr>
				<div class="col-sm-12">
					<h4><strong>NUEVA INCIDENCIA</strong></h4>
					<div class="" style="background-color: #686868;">
						<form>
							<div class="col-sm-4"><label>Dependencia</label><input class="campo"></div>
							<div class="col-sm-4"><label>Material</label><input class="campo"></div>
							<div class="col-sm-4"><label>Tipo</label><input class="campo"></div>
							<div type="textarea" class="col-sm-12"><label>Comentario</label><input class="campo" style="width: 100%;"></div>
							<div class="col-sm-12"><input type="submit" value="Publicar incidencia" class="campo envio"></div>
						</form>
					</div>
					<hr>
				</div>
				<hr>
				<div class="col-sm-12">
					<h4><strong>TUS INCIDENCIAS</strong></h4>
					<div class="" style="background-color: #686868;">
						<form>
							<div class="col-sm-2"><label>ID</label><input class="campo"></div>
							<div class="col-sm-3"><label>Dependencia</label><input class="campo"></div>
							<div class="col-sm-3"><label>Material</label><input class="campo"></div>
							<div class="col-sm-3"><label>Tipo</label><input class="campo"></div>
						</form>
					</div>
					<hr>
				</div>
			</div>
			<div class="col-sm-3 banner1 hidden-xs">
				Aqui iría un banner
			</div>
		</div>
		
		<?php
			include 'footer.php';
		?>
	
	</body>
</html>