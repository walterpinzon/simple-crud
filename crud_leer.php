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
        echo"					<input class=\"form-control\" id=\"$key\" name=\"$key\" type=\"text\" name=\"$key\" value=\"$value\"placeholder=\"" . str_replace('_',' ',$key) . "\">";
    	echo"				</div>";
    }
    $link = mysqli_connect($host_db, $user_db, $pwd_db) or die('No se pudo conectar: ' . mysqli_error());
    mysqli_select_db($link, $database) or die('No se pudo seleccionar la base de datos');
    
    if(empty($_GET['ID']) or $_GET['ID']<1)
    {
        $query = "select MAX(Id) AS Max_Id from $tabla";
        $result = mysqli_query($link, $query) or die('Consulta1 fallida: ' . mysqli_error());
       	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
       	$buscado=$line['Max_Id'];
    }
    else
    {
        $buscado=$_GET['ID'];
    }
    
    
    $query = 'SELECT * FROM `' . $tabla . '` WHERE `ID`='.$buscado.' ORDER BY `ID` DESC';
    $result = mysqli_query($link, $query) or die('Consulta1 fallida: ' . mysqli_error());
	$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo "<div class=\"container-fluid\"><div class=\"card shadow\"><div class=\"card-body\">";
	echo "<form class=\"needs-validation\" action=\"crud_guardar_actualizar.php\" method=\"POST\">
		<div class=\"form-row\">";
			
	array_walk($line,'imprimir_campos');
	$masuno=(int)$line['ID']+1;
	$menosuno=(int)$line['ID']-1;
	echo"	</div>
	    	<div class=\"form-row\">
				<div class=\"col-sm-2 mb-1 mt-3\">
					<a href=\"crud_leer.php?ID=$menosuno\"><div class=\"btn btn-outline-primary\"> < </div></a>
					<button class=\"btn btn-outline-success\" type=\"submit\">Actualizar</button>
<!--					<a href=\"crud_eliminar.php?ID=$line[ID]\"><div class=\"btn btn-outline-danger\"> - </div></a>-->
					<a href=\"crud_leer.php?ID=$masuno\"><div class=\"btn btn-outline-primary\"> > </div></a>
				</div>
			</div>
		</form>
		</div></div></div>";
?>
