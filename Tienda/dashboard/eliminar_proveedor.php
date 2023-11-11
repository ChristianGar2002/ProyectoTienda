<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="icon" href="../../img/logoquetzalt.jpg">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';
	
	if($_GET['id']){
		$id = $_GET['id'];

		//Se realiza la eliminacion con la instruccion DEELETE FROM
		$sql = "DELETE FROM proveedores WHERE id = {$id}";
		$sql2= "ALTER TABLE proveedores AUTO_INCREMENT=1";
		if(($conex -> query($sql) === TRUE) and ($conex -> query($sql2) === TRUE)){
			include_once("ver_proveedores.php");
      		echo '<script language="javascript">ProveedorEliminado();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>