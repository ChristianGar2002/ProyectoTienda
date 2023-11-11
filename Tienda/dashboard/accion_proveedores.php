<?php

	include("../conexion.php");
	//Se reciben los datos de la ventana modal para registrar proveedores
	if (isset($_POST['registrar_proveedor'])) {
			$nombre_proveedor= trim($_POST['nombre_proveedor']);
			$direccion= trim($_POST['direccion']);
			$codigo_postal= trim($_POST['codigo_postal']);
			$localidad= trim($_POST['localidad']);
			$telefono= trim($_POST['telefono']);
			$correo= trim($_POST['correo']);
			$fecha_registro= date("d/m/y");

			//Se realiza una verificacion para el nombre
			$verificacion = mysqli_query($conex, "SELECT * FROM proveedores WHERE nombre_proveedor='$nombre_proveedor'");

    			if (mysqli_num_rows($verificacion) > 0) {
    				include_once("ver_proveedores.php");
      				echo '<script language="javascript">ProveedorRepetido2();</script>';
      				exit();
    			}else{

					$consulta= "INSERT INTO proveedores( nombre_proveedor, direccion, codigo_postal, localidad, telefono, correo, fecha_registro) VALUES('$nombre_proveedor','$direccion','$codigo_postal','$localidad','$telefono','$correo', '$fecha_registro')";
					$resultado=mysqli_query($conex, $consulta);

			}

		if ($resultado == true) {
			require_once("ver_proveedores.php");			
			echo '<script language="javascript">ProveedorCreado();</script>';
		}else{
			require_once("ver_proveedores.php");
			echo '<script language="javascript">ProveedorFallido();</script>';
		}		
	}
?>