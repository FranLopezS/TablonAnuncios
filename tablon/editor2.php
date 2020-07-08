<?php
session_start();
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

.punto1 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 8%;
}

.punto2 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 12%;
}

.punto3 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 16%;
}

.punto4 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 20%;
}

.punto5 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 24%;
}

.punto6 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 28%;
}

.punto7 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 32%;
}

.punto8 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 36%;
}

.punto9 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 40%;
}

.punto10 {
	position: absolute;
	margin-top: 29.7%;
	margin-left: 44%;
}
.editor {
	position: absolute;
	margin-top: 3%;
	margin-left: 6.5%;
}
.permisos {
	position: absolute;
	margin-top: 7%;
	margin-left: 5.4%;
}

.mostrarp {
	position: absolute;
	margin-top: 12%;
	margin-left: 5.1%;
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
}
echo "<h2>Tablón de anuncios</h2>";
$band=false;
if(isset($_REQUEST['cod'])){
	$cod=$_REQUEST['cod'];
}
else
{
	$cod=1;
}
if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
	echo "<form name='editar' action='editar.php' method ='GET'><input type='hidden' name='codigo' value='$cod'/><div class='editor'><input type='submit' class='btn btn-primary' value='Editar post'></div></form>";
}

if($guardados>=1){
	if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
		echo "<div class='mostrarp'><center><a class='btn btn-primary' href='pguard.php' role='button'>Post guardados</a></center></div>";
	}
}
if($_SESSION["permiso"]==3){
	echo "<div class='permisos'><center><a class='btn btn-primary' href='permisos.php' role='button'>Editar usuarios</a></center></div>";
}
	include 'conexionbd.php';
	$conexion=mysqli_connect($host,$user,$pass,$bbdd);
	if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
		echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
	}
	else
	{
		$consulta="select * from mensajes;";
		$resultado=mysqli_query($conexion,$consulta);
		$n_pags=mysqli_num_rows($resultado);
		$n_menospags=$n_pags-1;
		$consulta="select * from mensajes where codigo=$cod;";
		if(!mysqli_query($conexion,$consulta)){
			echo "No hay noticia con el código $cod.";
		}
		else
		{
			// echo "Vas bien.";
			$resultado=mysqli_query($conexion,$consulta);
			while($fila=mysqli_fetch_array($resultado)){
					$codigo=$fila["codigo"];
					$autor=$fila["autor"];
					$titulo=$fila["titulo"];
					$cuerpo=$fila["cuerpo"];
					$fechap=$fila["fecha_publicacion"];
					$fechaf=$fila["fecha_fin"];
			}
			//echo "<table border='3' align='center' class='table'>";
			$newcod=$cod+1;
			$antcod=$cod-1;
			echo "<div class='tablon'></div><br><div class='circulo1'></div><div class='circulo2'></div><div class='circulo3'></div><div class='circulo4'></div>";
			echo "<div class='hoja' class='figure-img img-fluid rounded'></div>";
			echo "<div class='chincheta'></div>";
			if($cod==1){
				echo "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$n_pags'/><div class='img1'><input type=\"image\" src='izq.png'></div></form>";
			}
			else
			{
				echo "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$antcod'/><div class='img1'><input type=\"image\" src='izq.png'></div></form>";
			}
			echo "<a href='colocar.php'><div class='img2'><img src='colocar.png'></div></a>";
			echo "<form name='borrar' action='borrar.php' method ='GET'><input type='hidden' name='codigo' value='$cod'/><div class='img3'><input type=\"image\" src='borrar.png'></div></form>";
			if($cod==$n_pags){
				echo "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='1'/><div class='img4'><input type=\"image\" src='der.png'></div></form>";
			}
			else
			{
				echo "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$newcod'/><div class='img4'><input type=\"image\" src='der.png'></div></form>";
			}
			if($n_pags!==0){
				echo "<div class='titulo'><h1>$titulo</h1></div>";
				echo "<div class='cuerpo'>$cuerpo</div>";
				echo "<div class='autor'>De $autor, de $fechap a $fechaf</div>";
			}
			
			function circulo($n){
				include 'conexionbd.php';
				$conexion=mysqli_connect($host,$user,$pass,$bbdd);
				$consulta="select * from mensajes where codigo=$n;";
				if(mysqli_query($conexion,$consulta)){
					$resultado=mysqli_query($conexion,$consulta);
					while($fila=mysqli_fetch_array($resultado)){
						if(isset($fila)){
							if(isset($_REQUEST['cod'])){
								if($_REQUEST['cod']==$n){
									return "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$n'/><div class='punto$n'><input type=\"image\" src='circulo2.png'></div></form>";
								}
								else
								{
									return "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$n'/><div class='punto$n'><input type=\"image\" src='circulo.png'></div></form>";
								}
							}
							else
							{
								if($n==1){
									return "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$n'/><div class='punto$n'><input type=\"image\" src='circulo2.png'></div></form>";
								}
								else
								{
									return "<form name='registro' action='editor.php' method ='GET'><input type='hidden' name='cod' value='$n'/><div class='punto$n'><input type=\"image\" src='circulo.png'></div></form>";
								}
							}
						}
					}
				}
			}
			
			echo circulo(1);
			echo circulo(2);
			echo circulo(3);
			echo circulo(4);
			echo circulo(5);
			echo circulo(6);
			echo circulo(7);
			echo circulo(8);
			echo circulo(9);
			echo circulo(10);
			
			if(isset($_SESSION["estado"])){
				$cuenta=$_SESSION["cuenta"];
				if($_SESSION["estado"]==1){
					//echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a></div>";
					if($_SESSION["permiso"]==3){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>director</b>. <a href='editor2.php'><font color='pink'><font size='2'>EDITOR RÁPIDO</font></font></a></div>";
					}
					if($_SESSION["permiso"]==2){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>jefe de estudios</b>. <a href='editor2.php'><font color='pink'><font size='2'>EDITOR RÁPIDO</font></font></a></div>";
					}
					if($_SESSION["permiso"]==1){
						echo "<div class='session'>Bienvenid@, <b>$cuenta</b>. <a href='cerrarsesion.php'><font color='#d3872e'>Cerrar sesión</font></a><br>Tienes permisos de <b>profesor</b>. <a href='editor2.php'><font color='pink'><font size='2'>EDITOR RÁPIDO</font></font></a></div>";
					}
					$band=true;
				}
				else
				{
					echo "<a href='temporalinicio.php'><div class='session'><b>Iniciar sesión</b></div></a>";
				}
			}
			if(!$band){
				echo "<a href='temporalinicio.php'><div class='session'><b>Iniciar sesión</b></div></a>";
			}
		}
	}
?>

</body>
</html>