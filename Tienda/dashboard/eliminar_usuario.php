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

		$sql = "DELETE FROM usuarios WHERE id = {$id}";
		$sql2= "ALTER TABLE usuarios AUTO_INCREMENT=1";
		if(($conex -> query($sql) === TRUE) and ($conex -> query($sql2) === TRUE)){
			require_once("ver_usuarios.php");			
			echo '<script language="javascript">UsuarioEliminado();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>