<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["permiso"]==3){
	}
	else
	{
		header("Location: index.php");
	}
}
else
{
	header("Location: index.php");
}
?>
<html>
	<head>
		<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<style>
		body {
			background-attachment: fixed;
		}
		.session {
			position: absolute;
			color: #d3872e;
			background-color: #b25a19;
			margin-top: 0.5%;
			margin-left: 55%;
			border-style: solid;
			border-color: #d3872e;
			border-width: 1px;
			padding: 5px;
		}
		.tablon {
			float: left;
			background-image:url(wood.jpg);
			border-radius: 15px;
			width: 90%;
			height: 80%;
			margin-left: 5%;
			border-style: solid;
			border-color: #d3872e;
			border-width: 2px;
		}
		.colocarfor {
			position: absolute;
			margin-left: 33%;
			margin-top: 5%;
		}
h2 {
	color: white;
	font: 700 40px Century Gothic;
	padding-top: 15px;
	padding-bottom: 15px;
	background-color: #819FF7;
	text-align: center;
}
		</style>	
		</head>
	<body background="fondo1.png">

<?php
$email=$_REQUEST['email'];

include 'conexionbd.php';
	$conexion=mysqli_connect($host,$user,$pass,$bbdd);
	if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
		echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
	}
	else
	{
		$consulta="select * from usuarios where email='$email';";
		if(!mysqli_query($conexion,$consulta)){
			echo "No hay noticia con el código $cod.";
		}
		else
		{
			// echo "Vas bien.";
			$resultado=mysqli_query($conexion,$consulta);
			while($fila=mysqli_fetch_array($resultado)){
				$nya=$fila["nombre_apellidos"];
				$email=$fila["email"];
				$permiso=$fila["permiso"];
			}
		}
	}
?>
<h2>Editar usuario</h2>
<div class='colocarfor'>
	<form name="iniciosesion" action="procesa_edituser.php" method ="POST">
		<table border='3' align=center class="table table-dark">
			<tr><td><b>Nombre y apellidos</b></td><td><input type="text" value='<?php echo "$nya"; ?>' name="nya" required></td></tr>
			<tr><td><b>Email</b></td><td><input name="email" value='<?php echo "$email"; ?>' readonly></td></tr>
			<tr><td><b>Permiso</b></td><td><input type="number" name='permiso' max='2' min='1' value='<?php echo "$permiso"; ?>' required></td></tr>
			<input type='hidden' name='emal' value='<?php echo "$email"; ?>'>
			<tr><td colspan='2' align=center><input type="submit" class="btn btn-warning btn-sm" value="Editar"/></td></tr>
		</table>
	</form>
	<center><a class='btn btn-primary' href='permisos.php' role='button'>Volver al editor de usuarios</a></center>
</div>