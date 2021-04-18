<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<?php
    include ("config.php");
	 header('Content-Type: text/html; charset=ISO-8859-1');

function imprimir_campos($value,$key)
{
    echo "					<div class=\"col-sm-4 mb-0 mt-0\">";
    echo "						<label for=\"$key\"><font size=\"1\" color=\"#cccccc\">" . str_replace('_',' ',$key) . "</font></label><br>";
    echo"					<input class=\"form-control\" id=\"$key\" name=\"$key\" type=\"text\" placeholder=\"" . str_replace('_',' ',$key) . "\">";
	echo"				</div>";
}
    //$buscado=$_GET['mw'];
    $buscado=1;
    // Conectando, seleccionando la base de datos
    $link = mysqli_connect($host_db, $user_db, $pwd_db) or die('No se pudo conectar: ' . mysqli_error());
    mysqli_select_db($link, $database) or die('No se pudo seleccionar la base de datos');
    $query = 'SELECT * FROM `requerimientos` WHERE `ID`='.$buscado.' ORDER BY `ID` DESC';
    $result = mysqli_query($link, $query) or die('Consulta1 fallida: ' . mysqli_error());
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	array_shift($line);
	//var_dump($line);
	echo "<div class=\"container-fluid\"><div class=\"card shadow\"><div class=\"card-body\">";
	echo "<form class=\"needs-validation\" action=\"crud_guardar_actualizar.php\" method=\"POST\">
		<div class=\"form-row\">";
	
	echo "					<div class=\"col-sm-4 mb-0 mt-0 invisible\">";
    echo "						<label for=\"ID\"><font size=\"1\" color=\"#cccccc\">ID</font></label><br>";
    echo"					<input class=\"form-control invisible\" id=\"ID\" name=\"ID\" type=\"text\" >";
	echo"				</div>";
	
	array_walk($line,'imprimir_campos');


			
	echo"	</div>
	    	<div class=\"form-row\">
				<div class=\"col-sm-2 mb-1 mt-3\">
					<!--<button class=\"btn btn-outline-primary\" type=\"submit\"> < </button>-->
					<button class=\"btn btn-outline-primary\" type=\"submit\">Guardar Nuevo</button>
					<!--<button class=\"btn btn-outline-primary\" type=\"submit\"> > </button>-->
				</div>
			</div>
		</form>
		</div></div></div>";
?>
