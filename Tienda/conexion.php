<?php
//Conexión a la base de datos
	$conex= mysqli_connect("localhost", "root", "", "tienda");
	if (mysqli_connect_errno()) {
	 	echo "Conexion fallida: ", mysqli_connect_errno();
	 	exit();
	 } 
?>