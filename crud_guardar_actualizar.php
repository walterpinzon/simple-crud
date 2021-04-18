<?php
    include ("config.php");
	header('Content-Type: text/html; charset=ISO-8859-1');
	$campos = $valores = $llaves = "";
    function construir_campos_consulta_actualizar($value,$key)
    {
        $GLOBALS['campos'] = $GLOBALS['campos'] . "`$key`='$value', ";
    }
    function construir_campos_consulta_insertar($value,$key)
    {
        $GLOBALS['llaves'] = $GLOBALS['llaves'] . "`$key`, ";
        $GLOBALS['valores'] = $GLOBALS['valores'] . "'$value', ";
    }
    $link = mysqli_connect($host_db, $user_db, $pwd_db) or die('No se pudo conectar: ' . mysqli_error());
    mysqli_select_db($link, $database) or die('No se pudo seleccionar la base de datos');
    $id_actualizar=array_shift($_POST);//Elimino el ID del Array y lo guardo para actualizaciones
    if(empty($id_actualizar))//SI NO TIENE ID CREA UNO NUEVO DE LO CONTRARIO ACTUALIZA
    {
        array_walk($_POST,'construir_campos_consulta_insertar');//Uno los nombres de clave y valores en un scring
        $valores=substr($valores,0,-2);//quito la ultima coma y espacio
        $llaves=substr($llaves,0,-2);//quito la ultima coma y espacio
        $query = "INSERT INTO `$tabla` ($llaves) VALUES ($valores)";// AHORA SE IMPRIMIRAN LLAVES Y VALORES. 
    }
    else
    {
        array_walk($_POST,'construir_campos_consulta_actualizar');//Uno los nombres de clave y valores en un scring
        $campos=substr($campos,0,-2);//quito la ultima coma y espacio
        $query = "UPDATE $tabla SET " . $campos . " WHERE `ID` LIKE '$id_actualizar'";// AHORA SE IMPRIMIRAN LLAVES Y VALORES.
    }
    $result = mysqli_query($link, $query) or die('Consulta1 fallida: ' . mysqli_error());

	echo "<script>window.location.replace(\"crud_leer.php\");  </script>";
?>
