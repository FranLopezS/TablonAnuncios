<?php
session_start();
?>
<html>
	<head>
		<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
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
				width: 90%;
				height: 80%;
				margin-left: 5%;
				margin-top: 5%;
				border-style: solid;
				border-color: #d3872e;
				border-width: 2px;
			}
			.autor {
				position: absolute;
				margin-top: 40%;
				margin-left: 55%;
			}
			.titulo {
				position: absolute;
				margin-top: 8%;
				margin-left: 15%;
			}
			.cuerpo {
				position: absolute;
				width: 60%;
				height: 50%;
				margin-left: 20.2%;
				background-color: white;
				border-radius: 10px;
				padding: 5px;
				color: black;
			}
			.boton {
				position: absolute;
				width: 5%;
				height: 10%;
				margin-top: 7%;
				margin-left: 93%;
				background-image:url(wood.jpg);
				border-radius: 50px;
			}
			h2 {
				color: white;
				font: 700 40px Century Gothic;
				padding-bottom: 10px;
				background-color: #819FF7;
				text-align: center;
			}
			.tit {
				color: black;
			}
		</style>
	</head>
	<body background="fondo1.png">
<h2>Tablón de anuncios</h2>
<?php
//echo "<a href='iniciosesion.php'><div class='boton'></div></a>";
//echo "<div class='tablon'></div>";
echo "<center>";
if(isset($_REQUEST['cod'])){
	$cod=$_REQUEST['cod'];
}
else
{
	$cod=1;
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
	$n_menospags=$n_pags;
	$fechahoy=date("Y-m-d");
	while($fila=mysqli_fetch_array($resultado)){
		$codigo=$fila["codigo"];
		$fechaf=$fila["fecha_fin"];
		if($fechaf<=$fechahoy){
			/*$consulta="select * from mensajes;";
			$resultado=mysqli_query($conexion,$consulta);
			$n_pags=mysqli_num_rows($resultado);
			if($codigo<$n_pags){
				for($i=$codigo;$i<=$n_pags;$i++){
					$codigo++;
					$consulta="UPDATE `mensajes` SET `codigo`='$i' WHERE codigo='$codigo';";
					$codigo--;
					if(!mysqli_query($conexion,$consulta)){
						//header("Location: index.php");
					}
				}
			}*/
			$consulta="DELETE FROM `mensajes` WHERE codigo='$codigo';";
			header("Location: index.php");
			if(!mysqli_query($conexion,$consulta)){
				echo "Fallo.";
			}
		}
	}
}
?>
<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	  <?php for($i=1;$i<$n_menospags;$i++){
      echo '<li data-target="#myCarousel" data-slide-to="$i"></li>';
	  }
	  ?>
    </ol>

    <!-- Wrapper for slides -->
<?php
$consulta="select * from mensajes;";
	$resultado=mysqli_query($conexion,$consulta);
	if(!mysqli_query($conexion,$consulta)){
		echo "No hay noticia con el código $cod.";
	}
		else
	{
		$c=1;
		while($fila=mysqli_fetch_array($resultado)){
			$codigo=$fila["codigo"];
			$autor=$fila["autor"];
			$titulo=$fila["titulo"];
			$cuerpo=$fila["cuerpo"];
			$fechap=$fila["fecha_publicacion"];
			$fechaf=$fila["fecha_fin"];
			if($c==1){
				echo "<div class=\"carousel-inner\">
				<div class=\"item active\">
				<img src=\"wood.jpg\" alt=\"Los Angeles\" style=\"width:75%;\">
				<div class=\"carousel-caption\">";
				echo "<div class='tit'><h1><u>$titulo</u></h1>
					<br>
					<p>$cuerpo</p>
					<br>
					<h4><b>$autor</b></h4>
					<p><i>Del <b>$fechap</b> al <b>$fechaf</b></i></p>
				</div>
				</div></div>";
			}
			else
			{
				echo "<div class=\"item\">
				<img src=\"wood.jpg\" alt=\"Chicago\" style=\"width:75%;\">
				<div class=\"carousel-caption\">
					<div class='tit'><h1><u>$titulo</u></h1>
					<br>
					<p>$cuerpo</p>
					<br
					<h4><b>$autor</b></h4>
					<p><i>De <b>$fechap</b> a <b>$fechaf</b></i></p>
				</div>
				</div></div>";
			}
			$c++;
		}
	}
/*for($i=1;$i<$n_menospags;$i++){
	$i++;
	$consulta="select * from mensajes where codigo='$i';";
	$resultado=mysqli_query($conexion,$consulta);
	if(!mysqli_query($conexion,$consulta)){
		echo "No hay noticia con el código $cod.";
	}
		else
	{
		while($fila=mysqli_fetch_array($resultado)){
			$codigo=$fila["codigo"];
			$autor=$fila["autor"];
			$titulo=$fila["titulo"];
			$cuerpo=$fila["cuerpo"];
			$fechap=$fila["fecha_publicacion"];
		}
		$i--;
		echo "<div class=\"item\">
				<img src=\"negro.png\" alt=\"Chicago\" style=\"width:75%;\">
				<div class=\"carousel-caption\">
					<h1>$titulo</h1>
					<p>$cuerpo</p>
					<h4>$autor</h4>
					<p>$fechap</p>
				</div>
			</div>";
	}
}*/

?>
      <!--<div class="item">
        <img src="wood.jpg" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          <h3>Chicago</h3>
          <p>Thank you, Chicago!</p>
        </div>
      </div>
    
      <div class="item">
        <img src="wood.jpg" alt="HIjdoaiskjcfo" style="width:100%;">
        <div class="carousel-caption">
          <h3>New York</h3>
          <p>We love the Big Apple!</p>
        </div>
      </div>
    </div>-->

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<center><a class='btn btn-primary' href='iniciosesion.php' role='button'>Iniciar sesión</a></center>
	</body>
</html>