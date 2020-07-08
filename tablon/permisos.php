<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="editor2.css" type="text/css" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
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
$n_color=1;
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="select * from usuarios;";
	if(!mysqli_query($conexion,$consulta)){
		echo "No hay noticias.";
	}
	else
	{
		echo "<h2>Panel de administración de usuarios</h2>";
		echo "<table border='3' align='center' class='table'>";
		echo "<tr align='center' class='table-secondary'><th><font size='2'>Nombre y apellidos</font></th><th><font size='2'>Email</font></th><th><font size='2'>Permiso</font></th><th>Editar</th><th>Borrar</th></tr>";
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
			$nya=$fila["nombre_apellidos"];
			$email=$fila["email"];
			$permiso=$fila["permiso"];
			if($permiso==1 || $permiso==2){
				echo "<tr align='center' class='$color'><th><font size='2'>$nya</font></th><td><font size='2'>$email</font></td><td><font size='2'>$permiso</font></td><td><form name='registro' action='editoruser.php' method ='GET'><input type='hidden' name='email' value='$email'/><input type='submit' name='Editar' class='btn btn-warning' value='A'/></form></td><td><form name='registro' action='borrauser.php' method ='GET'><input type='hidden' name='email' value='$email'/><input type='submit' name='Borrar' class='btn btn-danger' value='A'/></form></td></tr>";
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
echo "<center><a class='btn btn-primary' href='crearuser.php' role='button'>Usuario nuevo</a> <a class='btn btn-primary' href='editor.php' role='button'>Volver al editor</a> <a class='btn btn-primary' href='index.php' role='button'>Volver al tablón</a></center>";







/*if(isset($_SESSION["estado"])){
	if($_SESSION["estado"]==1){
		header('Location: colocar.php');
	}
	else
	{
		header('Location: index.php');
	}
}
else
{
	header('Location: index.php');
}*/
?>
	</body>
</html>