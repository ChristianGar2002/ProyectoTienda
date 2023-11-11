<?php 
	header("Content-Type:aplication/vnd.ms-excel; charset=iso-8859-1");
	//header("Content-Type:aplication/vnd.ms-excel");Al formato mas reciente de excel
	header("Content-Disposition:attachment;filename=proveedores.xls");
	$fecha_reporte= date("d/m/y");


?>
<head>
	<style type="text/css">
table {
   width: 100%;
   border: 1px solid #000;
}
th, td {
   width: 25%;
   vertical-align: top;
   border: 1px solid #000;
   border-collapse: collapse;
   padding: 0.3em;
   caption-side: bottom;
}
th {
   background: #eee;
}
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<table class="table text-center" style="border: 1px solid black; text-align: center;">
		<caption ><p style="font-size: 24px;"><b>Reporte de proveedores</b><br><p style="font-size: 20px;"><b>Fecha: </b><?php echo $fecha_reporte ?></p></p></caption>
		<tr class="thead-dark">
          <th style="font-size: 18px;background-color: #C6C6C6;">ID</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Nombre del proveedor</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Dirección</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Codigo postal</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Localidad</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Telefono</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Correo</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Fecha de registro</th>
		</tr>
			<?php
				include("../conexion.php");
				$sql="SELECT * FROM proveedores";
					$ejecutar=mysqli_query($conex, $sql);
					while ($fila=mysqli_fetch_array($ejecutar)) {
					?>
			<tr style="text-align: center; font-size: 13px;">
				<td style="font-size: 16px;"><?php echo $fila[0]?></td><!--Para imprimir el contedio de la tabla --> 
				<td style="font-size: 16px;"><?php echo $fila[1]?></td>
				<td style="font-size: 16px;"><?php echo $fila[2]?></td>
				<td style="font-size: 16px;"><?php echo $fila[3]?></td>
				<td style="font-size: 16px;"><?php echo $fila[4]?></td>
				<td style="font-size: 16px;"><?php echo $fila[5]?></td>
				<td style="font-size: 16px;"><?php echo $fila[6]?></td>
				<td style="font-size: 16px;"><?php echo $fila[7]?></td>
				
		<?php } ?>
			</tr>
					
	</table>

