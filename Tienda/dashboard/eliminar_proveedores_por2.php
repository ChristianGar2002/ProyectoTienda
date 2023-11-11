<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion Eliminacion</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Capturamos los valores del formulario
	if($_POST){
		$campo= trim($_POST['campo']);
		$valor= trim($_POST['valor']);


		$verificacion = mysqli_query($conex, "SELECT * FROM proveedores WHERE $campo='$valor'");

    		if (mysqli_num_rows($verificacion) > 0) {
      			//Realizamos la eliminación con la instrucción DELETE FROM	
      			$sql = "DELETE FROM proveedores WHERE $campo='$valor'";
				$sql2= "ALTER TABLE proveedores AUTO_INCREMENT=1";
				
				if(($conex -> query($sql) === TRUE) and ($conex -> query($sql2) === TRUE)){
					include_once("ver_proveedores.php");
      				echo '<script language="javascript">ProveedoresEliminadosPor();</script>';

      				exit();

				}else{

					require_once("ver_proveedores.php");			
					echo '<script language="javascript">ProveedoresFallidosDatos();</script>';

      				exit();
				}

    	}else{

    		require_once("ver_proveedores.php");			
			echo '<script language="javascript">ProveedoresEliminadosVerificacion();</script>';
			
      		exit(); 		
      	}

	$conex ->close();
	}


?>
