<?php 
	header("Content-Type:aplication/vnd.ms-excel; charset=iso-8859-1");
	//header("Content-Type:aplication/vnd.ms-excel");Al formato mas reciente de excel
	header("Content-Disposition:attachment;filename=categorias.xls");
	$fecha_reporte= date("d/m/y");

?>
<head>
<style type="text/css">
table {
   width: 50%;
   border: 1px solid #000;
   margin-left: auto;
   margin-right: auto;
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
		<caption ><p style="font-size: 24px;"><b>Reporte de categorias</b><br><p style="font-size: 20px;"><b>Fecha: </b><?php echo $fecha_reporte ?></p></p></caption>
		<tr class="thead-dark">
          <th style="font-size: 18px;background-color: #C6C6C6;">ID</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Categoria</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Fecha de registro</th>
		</tr>
			<?php
				include("../conexion.php");
				$sql="SELECT * FROM categorias";
					$ejecutar=mysqli_query($conex, $sql);
					while ($fila=mysqli_fetch_array($ejecutar)) {
					?>
			<tr style="text-align: center; font-size: 13px;">
				<td style="font-size: 16px;"><?php echo $fila[0]?></td>
				<td style="font-size: 16px;"><?php echo $fila[1]?></td>
				<td style="font-size: 16px;"><?php echo $fila[2]?></td>
				
		<?php } ?>
			</tr>
					
	</table>

