<?php
    include ("config.php");
	header('Content-Type: text/html; charset=ISO-8859-1');
	
    if(!empty($_GET['ID']))//SI NO TIENE ID CREA UNO NUEVO DE LO CONTRARIO ACTUALIZA
    {
        $link = mysqli_connect($host_db, $user_db, $pwd_db) or die('No se pudo conectar: ' . mysqli_error());
        mysqli_select_db($link, $database) or die('No se pudo seleccionar la base de datos');
        $query = "DELETE FROM `$tabla` WHERE `ID` LIKE '$_GET[ID]'";
        //echo "<pre>";
        //var_dump($query);
        $result = mysqli_query($link, $query) or die('Consulta1 fallida: ' . mysqli_error());
    }

	echo "<script>window.location.replace(\"crud_leer.php\");  </script>";
?>
