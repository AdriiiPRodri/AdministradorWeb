<html>
	<head>
		<?php
			include 'head.php';
		?>
		
	</head>
	
	<body class="body">
		<?php
			include 'cabecera.php';
		?>
	
		<div class="container contenedor">
			<!--Contenido pagina principal, esta estará antes del login para que puedan acceder a las distintas herramientas los usuarios hasta que se cree un login único, aquí habrá una breve descripción, si encuentro el código en internet aquí el texto irá cambiando por lo que vayamos a poner en cada caja-->
			
			<div class="hidden-xs">
				<img class="slider" src="images/slider.png">
			</div>
			
			<div class="col-sm-9">
			<hr>
				<div class="col-sm-12">
					<h4><strong>Lorem ipsum dolor sit amet, consectetur adipiscing.</strong></h4>
		
			<div>
			<!--Script para comprobar que el navegador del usuario tiene las cookies habilitadas ya que trabajaremos con estas-->
			<script language="JavaScript">
			function IsCookiesEnabled(){ //Funcion que comprueba si las cookies estan habilitadas en el navegador del cliente.
			document.cookie = 'testcookie';
			var result = (document.cookie.indexOf('testcookie') != -1);
			document.cookie = 'testcookie; expires=Thu, 01-Jan-70 00:00:01 GMT';
			return result;
			}
			</script>
			<!--Este es el formulario de logueo*/-->
				<form method="post" action="autenticacion.php" align="center" name="formulario_usuario">
				<STRONG>Nombre Usuario:</STRONG>&nbsp;&nbsp;<input name="auth_user" type="text"><BR/>
				<STRONG>Contraseña:</STRONG>&nbsp;&nbsp;&nbsp;<input name="auth_pass" type="password"><br/>
				<input name="redirurl" type="hidden" value="$PORTAL_REDIRURL$">
				<input name="accept" type="submit" value="Login">
			</div>
			<script languaje="JavaScript">
			<!--Ejecutamos la funcion IsCookiesEnabled definida anteriormente-->
			if(IsCookiesEnabled()){
				//No hago nada, ya que las cookies están habilitadas en el navegador del cliente.
			}else{
				alert('Para que la aplicación funcione correctamente, es necesario habilitar las Cookies en su navegador');
			}
					
			</script>
			<div class="col-sm-3 banner1 hidden-xs">
				Aqui iría un banner
			</div>
		</div>
		
		<?php
			include 'footer.php';
		?>
	</body>
</html>