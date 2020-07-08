<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="editor2.css" type="text/css" />
		<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
		h2 {
				color: white;
				font: 700 40px Century Gothic;
				padding-top: 20px;
				padding-bottom: 20px;
				background-color: #819FF7;
				text-align: center;
			}
.session {
	position: absolute;
	color: #d3872e;
	background-color: #b25a19;
	margin-top: 1%;
	margin-left: 70%;
	border-style: solid;
	border-color: #d3872e;
	border-width: 1px;
	padding: 5px;
}
		</style>
	</head>
		<body background="fondo1.png">
<?php
if(isset($_SESSION["estado"])){
				$cuenta=$_SESSION["cuenta"];
				if($_SESSION["estado"]==1){
					//echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a></div>";
					if($_SESSION["permiso"]==3){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>director</b>.</div>";
					}
					if($_SESSION["permiso"]==2){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>jefe de estudios</b>.</div>";
					}
					if($_SESSION["permiso"]==1){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>profesor</b>.</div>";
					}
					$band=true;
				}
				else
				{
					echo "<a href='temporalinicio.php'><div class='session'><b>Iniciar sesión</b></div></a>";
				}
			}
echo "<h2>Tablón de anuncios</h2>";
$n_color=1;
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="select * from mensajes_guardados;";
	$resultado=mysqli_query($conexion,$consulta);
	$guardados=mysqli_num_rows($resultado);
	$consulta="select * from mensajes;";
	if(!mysqli_query($conexion,$consulta)){
		echo "No hay noticias.";
	}
	else
	{
		echo "<table border='3' align='center' class='table'>";
		echo "<tr align='center' class='table-secondary'><th><font size='2'>Código</font></th><th><font size='2'>Autor</font></th><th><font size='2'>Título</font></th><th><font size='2'>Fecha de publicación</font></th><th><font size='2'>Fecha de fin</font></th><th><font size='2'>Cuerpo del mensaje</font></th><th><font size='2'>Editar</font></th><th><font size='2'>Borrar</font></th></tr>";
		$resultado=mysqli_query($conexion,$consulta);
		while($fila=mysqli_fetch_array($resultado)){
			if($n_color==1){
				$color="table-info";
			}
			if($n_color==2){
				$color="table-success";
			}
			if($n_color==3){
				$color="table-warning";
			}
			if($n_color==4){
				$color="table-light";
			}
			$codigo=$fila["codigo"];
			$autor=$fila["autor"];
			$titulo=$fila["titulo"];
			$cuerpo=$fila["cuerpo"];
			$fechap=$fila["fecha_publicacion"];
			$fechaf=$fila["fecha_fin"];
			if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
				echo "<tr align='center' class='$color'><th><font size='2'>$codigo</font></th><td><font size='2'>$autor</font></td><td><font size='2'>$titulo</font></td><td><font size='2'>$fechap</font></td><td><font size='2'>$fechaf</font></td><td><font size='2'>$cuerpo</font></td><td><form name='registro' action='editar.php' method ='GET'><input type='hidden' name='codigo' value='$codigo'/><input type='submit' name='Editar' class='btn btn-warning' value='☻'/></form></td><td><form name='registro' action='borrar.php' method ='GET'><input type='hidden' name='codigo' value='$codigo'/><input type='submit' name='Borrar' class='btn btn-danger' value='☻'/></form></td></tr>";
			}
			else
			{
				echo "<tr align='center' class='$color'><th><font size='2'>$codigo</font></th><td><font size='2'>$autor</font></td><td><font size='2'>$titulo</font></td><td><font size='2'>$fechap</font></td><td><font size='2'>$fechaf</font></td><td><font size='2'>$cuerpo</font></td><td>X</td><td>X</td></tr>";
			}
			if($n_color==4){
				$n_color=1;
			}
			else
			{
				$n_color++;
			}
		}
	}
}
echo "</table>";
echo "<p><center><a class='btn btn-primary' href='colocar.php' role='button'>Post nuevo</a> <a class='btn btn-primary' href='index.php' role='button'>Volver al tablón</a></center><br></p>";
if($guardados>=1){
	if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
		echo "<p><center><a class='btn btn-primary' href='pguard.php' role='button'>Post guardados</a></center></p>";
	}
}
if($_SESSION["permiso"]==3){
	echo "<p><center><a class='btn btn-primary' href='permisos.php' role='button'>Editar usuarios</a></center></p>";
}
?>
	</body>
</html>