<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion Eliminación</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Capturamos los valores del formulario
	if($_POST){
		$campo= trim($_POST['campo']);
		$valor= trim($_POST['valor']);

		$verificacion = mysqli_query($conex, "SELECT * FROM productos_vendidos WHERE $campo='$valor'");

    		if (mysqli_num_rows($verificacion) > 0) {
      			//Realizamos la eliminación con la instrucción DELETE FROM
      			$sql = "DELETE FROM productos_vendidos WHERE $campo = '$valor'";

      			//Codigo para eliminar producto del grafico de productos vendidos

				$resultado_2= mysqli_query($conex, "SELECT * FROM ventas WHERE $campo='$valor'");

				$cantidad_pv=0;

				foreach($resultado_2 as $item):

        			$codigo=$item['codigo'];

        			$cantidad_pv=$item['cantidad'];

    			endforeach;

   				$verificacion= mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto={$codigo}");

    			if (mysqli_num_rows($verificacion) > 0) {

    				$resultado_3= mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto={$codigo}");

    				foreach($resultado_3 as $item):

        				$cantidad_gv=$item['cantidad'];

    				endforeach;

    			$valor2=$cantidad_gv-$cantidad_pv;

    			if($valor2>0){

    				$sql_2 = "UPDATE grafica_vendidos SET cantidad = '$valor2' WHERE codigo_producto={$codigo}";

    			$resultado_final=mysqli_query($conex, $sql_2);

    			} else if($valor2<=0){

    				$sql = "DELETE FROM grafica_vendidos WHERE codigo_producto={$codigo}";
    			}
  			}

		//Fin del codigo para eliminar producto del grafico de productos vendidos

				if(($conex -> query($sql) === TRUE)){
					include_once("productos_vendidos.php");
      				echo '<script language="javascript">ProductosVendidosEliminadosPor();</script>';

      				exit();

				}else{

					require_once("productos_vendidos.php");			
					echo '<script language="javascript">ProductosVendidosFallidosDatos();</script>';

      				exit();
				}

    	}else{

    		require_once("productos_vendidos.php");			
			echo '<script language="javascript">ProductosVendidosEliminadosVerificacion();</script>';
			
      		exit(); 		
      	}

	$conex ->close();
	}


?>
