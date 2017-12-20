<?php
include ("conexion.php");
//Comprobamos con isset que tengan valor ambas cookies y si es así que prosiga, en caso de no serlo acabara el script
if(isset($_COOKIE["nick"]) AND isset($_COOKIE["pass"])) {
	//Seleccionamos la base de datos sobre la que vamos a hacer la consulta
	mysql_select_db("gestionabdera", $conexion);
	//Comprobamos que la cookie a sido creada legitimamente y no con algun programa externo, para ello realizamos una consulta usando los valores de las cookies
	$result = mysql_query("SELECT * FROM Usuarios WHERE ID_usuario='".$_COOKIE["nick"]."' AND Contrasena='".$_COOKIE["pass"]."'");
	if(mysql_fetch_array($result)) {
		//Para generar un pdf seguiremos los siguientes pasos:
		//Primero utilizaremos las clases “class.ezpdf.php” y “class.pdf.php”, además de la carpeta “fonts” por si deseamos hacer uso
		//de distintas fuentes. Incluimos nuestro archivo ezpdf de la siguiente manera(se encuentra en htdocs/pdf del proyecto).
		require_once('pdf/class.ezpdf.php');
		$pdf = new Cezpdf('A4'); //seleccionamos tipo de hoja
		$pdf->selectFont('pdf/fonts/Helvetica.afm'); //seleccionamos fuente a utilizar
		//Haremos nuestra consulta
		$sql="SELECT * FROM incidencias WHERE N_incidencia='".$_POST['id_incidencia']."'";
		//realizamos nuestra consulta
		$resSql=mysql_query($sql) or die("<br>Error consulta</br>".mysql_error());
		//Ahora ya tenemos nuestros datos dentro de la variable $resSql
		//habrá recorrer los datos y convertirlos en un array, eso lo podemos hacer con un while y no se nos olvide colocar los títulos:
		while($row=mysql_fetch_row($resSql)){
			//la estructura será 'Nombre campo'=> posición del arreglo y la información
			$data[]=array('N_incidencia'=>$row[0], 'Descripcion'=>$row[1], 'Dependencia'=>$row[2], 'Fecha y hora'=>$row[3], 'Estado'=>$row[4], 'Tipo'=>$row[5], 'Usuario'=>$row[6], 'Comentario'=>$row[8]);
		}
		$titles=array('N_incidencia'=>'N_incidencia', 'Descripcion'=>'Descripcion','Departamento'=>'Departamento','Dependencia'=>'Dependencia', 'Fecha y hora'=>'Fecha y hora', 'Estado'=>'Estado', 'Tipo'=>'Tipo', 'Usuario'=>'Usuario');
		//Y ya por último generamos el pdf:
		$pdf->ezTable($data);
		$pdf->ezStream();
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