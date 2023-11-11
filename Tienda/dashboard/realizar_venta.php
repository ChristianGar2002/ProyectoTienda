<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Realizar venta</title>

		<!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Alerta personalizada de javascript -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

   <!-- Estilos de bosstrap-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
	<script type="text/javascript">
		function ProductoNoExistente(){
	        Swal.fire({
  					icon: 'error',
  					text: 'El producto ingresado no existe como tal!',
					}).then((result) => {
  					if (result.isConfirmed) {
    					window.location.href = "ventas.php";
  					}
				})

	    }

	     function VentaRealizada(){
	     	<?php require_once("realizar_venta.php") ?>
          Swal.fire({
            icon: 'success',
            title: 'Venta realizada exitosamente',
            html:'<b>Cantidad de registros:</b> <?php echo $cambio; ?>',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas.php";
            }
        })

      }

      function VentaEliminada(){
          Swal.fire({
            icon: 'success',
            title: 'Venta eliminada exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }

</script>
</body>
</head>
</html>
<?php

	require_once '../conexion.php';

 $verificacion = mysqli_query($conex, "SELECT * FROM ventas WHERE ACTIVO='1'");

if (mysqli_num_rows($verificacion) > 0) { 

	//Se capturan los datos enviados por el formulario
	if ($_POST) {
		$cobro= trim($_POST['cobro']);
		$total_2= trim($_POST['total_2']);
		$cambio=$cobro-$total_2;
		if($cambio<0){
			$cambio2=$cambio*-1;
			$cambio=$cambio2;
		}else{
			$cambio;
		}

		//Se realiza la venta
		$resultado = mysqli_query($conex, "SELECT * FROM ventas ORDER BY id_venta DESC LIMIT 1");

    	$reporte=0;
    
    	foreach($resultado as $item):

       		$reporte=$item['id_venta'];

    	endforeach;

    $valor=$reporte+1;

		$sql = "UPDATE ventas SET ACTIVO = '2', id_venta = '$valor' WHERE id_venta='0'";

		if(($conex -> query($sql) === TRUE)){
		//Seccion para introducir datos a la tabla productos_vendidos
		$resultado_vendidos = mysqli_query($conex, "SELECT * FROM ventas WHERE id_venta='$valor' and ACTIVO=2");

		foreach($resultado_vendidos as $item):

			//Agregar los datos a la tabla productos_vendidos

      $id_venta=$item['id_venta'];

      $codigo=$item['codigo'];

      $descripcion=$item['descripcion'];

      $precio=$item['precio'];

      $cantidad=$item['cantidad'];

      $fecha_registro= date("d/m/y");

      $query_2 = "INSERT INTO productos_vendidos(id_venta, codigo, descripcion, precio, cantidad, fecha_registro) VALUES ('$id_venta', '$codigo','$descripcion', '$precio', '$cantidad', '$fecha_registro')";
      $resultado_2=mysqli_query($conex, $query_2);

      //Codigo necesario para la grafica de los productos vendidos

      $verificacion = mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto='$codigo'");

      if (mysqli_num_rows($verificacion) > 0) {

      	$resultado = mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto='$codigo'");

      	foreach($resultado as $item2):

              $cantidad_2=$item2['cantidad'];

        endforeach;

          $valor=$cantidad+$cantidad_2;

          $sql = "UPDATE grafica_vendidos SET cantidad = '$valor' WHERE codigo_producto={$codigo}";

          $resultado=mysqli_query($conex, $sql);


      } else{

      	$query_3 = "INSERT INTO grafica_vendidos(codigo_producto, descripcion_producto, cantidad) VALUES ('$codigo','$descripcion','$cantidad')";
      $resultado_3=mysqli_query($conex, $query_3);

      }

    	endforeach;

    	//Fin del codigo necesario para la grafica de productos vendidos

			 require_once("ventas_alertas.php");
      		echo '<script language="javascript">VentaRealizada();</script>';
			$valor=$valor;
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
  }
}else{
	require_once("PDF/ventas_alertas_2.php");
    echo '<script language="javascript">SinDatosVenta();</script>';
}
?>
