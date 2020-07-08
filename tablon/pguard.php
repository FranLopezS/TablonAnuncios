<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
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
		<!--<link rel="stylesheet" href="editor.css" type="text/css" />-->
		<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css">
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

.circulo1 {
	position: absolute;
	background-color: #b25a19;
	border-radius: 30px;
	width: 19%;
	height: 10%;
	margin-top: 33%;
	margin-left: 10%;
	border-style: solid;
	border-color: #d3872e;
	border-width: 2px;
}

.circulo2 {
	position: absolute;
	background-color: #b25a19;
	border-radius: 30px;
	width: 19%;
	height: 10%;
	margin-top: 33%;
	margin-left: 30%;
	border-style: solid;
	border-color: #d3872e;
	border-width: 2px;
}

.circulo3 {
	position: absolute;
	background-color: #b25a19;
	border-radius: 30px;
	width: 19%;
	height: 10%;
	margin-top: 33%;
	margin-left: 50%;
	border-style: solid;
	border-color: #d3872e;
	border-width: 2px;
}

.circulo4 {
	position: absolute;
	background-color: #b25a19;
	border-radius: 30px;
	width: 19%;
	height: 10%;
	margin-top: 33%;
	margin-left: 70%;
	border-style: solid;
	border-color: #d3872e;
	border-width: 2px;
}

.img1 {
	position: absolute;
	margin-top: 34.1%;
	margin-left: 16%;
}

.img2 {
	position: absolute;
	margin-top: 33%;
	margin-left: 34.7%;
}

.img3 {
	position: absolute;
	margin-top: 33%;
	margin-left: 55.2%;
}

.img4 {
	position: absolute;
	margin-top: 33%;
	margin-left: 80%;
}

.hoja {
	position: absolute;
	background-image: url("papel.jpg");
	/*background-color: white;*/
	width: 70%;
	height: 62%;
	margin-left: 15%;
	border-style: solid;
	border-color: black;
	border-width: 1px;
}

.chincheta {
	position: absolute;
	background-color: blue;
	border-radius: 50px;
	width: 2%;
	height: 4%;
	margin-left: 48.9%;
	margin-top: 1%;
}

.autor {
	position: absolute;
	margin-top: 27%;
	margin-left: 55%;
}

.titulo {
	position: absolute;
	margin-top: 3%;
	margin-left: 25%;
}

.cuerpo {
	position: absolute;
	width: 60%;
	height: 50%;
	margin-top: 7%;
	margin-left: 20.2%;
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
echo "<h2>Tablón de mensajes guardados</h2>";
$band=false;
if(isset($_REQUEST['cod'])){
	$cod=$_REQUEST['cod'];
}
else
{
	$cod=1;
}
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
		$n_pags=mysqli_num_rows($resultado);
		$n_menospags=$n_pags-1;
		$consulta="select * from mensajes_guardados;";
		if(!mysqli_query($conexion,$consulta)){
			echo "No hay noticia con el código $cod.";
		}
		else
		{
			// echo "Vas bien.";
			echo "<table border='3' align='center' class='table'>";
		echo "<tr align='center' class='table-secondary'><th><font size='2'>Código</font></th><th><font size='2'>Autor</font></th><th><font size='2'>Título</font></th><th><font size='2'>Fecha de publicación</font></th><th><font size='2'>Fecha de fin</font></th><th><font size='2'>Cuerpo del mensaje</font></th><th><font size='2'>Publicar</font></th><th><font size='2'>Editar</font></th><th><font size='2'>Borrar</font></th></tr>";
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
				echo "<tr align='center' class='$color'><th><font size='2'>$codigo</font></th><td><font size='2'>$autor</font></td><td><font size='2'>$titulo</font></td><td><font size='2'>$fechap</font></td><td><font size='2'>$fechaf</font></td><td><font size='2'>$cuerpo...</font></td><td><form name='colocar' action='procesa_pguard.php' method ='GET'><input type='hidden' name='cod' value='$codigo'/><input type='submit' name='Colocar' class='btn btn-light' value='☻'/></form></td><td><form name='registro' action='editar.php' method ='GET'><input type='hidden' name='codigo' value='$codigo'/><input type='submit' name='Editar' class='btn btn-warning' value='☻'/></form></td><td><form name='registro' action='borrar.php' method ='GET'><input type='hidden' name='codigo' value='$codigo'/><input type='submit' name='Borrar' class='btn btn-danger' value='☻'/></form></td></tr>";
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
			echo "</table><center><a class='btn btn-primary' href='editor.php' role='button'>Volver al editor</a></center>";
		}
	}
}

?>
</body>
</html>