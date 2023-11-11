<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la libreria FPD

	include('pdf_mc_table_ventasT.php');

	include_once("fpdf184/fpdf.php");


//Cuerpo de la tabla	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM ventas WHERE ACTIVO = 2") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM ventas WHERE ACTIVO = 2");
	$fecha_registro= date("d/m/y");

	

//make new object
$pdf = new PDF_MC_Table("L");

//add page, set font

//Header
	$pdf -> AddPage();

	$pdf -> SetAutoPageBreak(true,20);

	//Footer
	$pdf->AliasNbPages();

//Fecha
$pdf->SetFont('Arial', 'B', 16);

		$pdf->SetY(28);
		//Movemos a la derecha la imagen
		$pdf->Cell(70);
		//Cuadro de titulo
		$pdf->Cell(100,10,"Fecha: ",0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(28);
		//Movemos a la derecha la imagen
		$pdf->Cell(90);
		//Cuadro de titulo
		$pdf->Cell(100,10,$fecha_registro,0,0,'C');

		$pdf->Ln(10);


$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(30,45,70,30,28,48,25));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//add table heading using standard cells
//set font to bold
//$prueba=['ID',''];

//$pdf->Row(Array(

	//$prueba[0],
	//));

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(30,6,utf8_decode('Id_venta'),1,0,'C',1);
$pdf->Cell(45,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(70,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(30,6,"Precio",1,0,'C',1);
$pdf->Cell(28,6,"Cantidad",1,0,'C',1);
$pdf->Cell(48,6,"Fecha de registro",1,0,'C',1);
$pdf->Cell(25,6,"Total",1,0,'C',1);

$pdf->Ln();

//Funcion para el formato de precios y totales

function SetCurrency(float $valor, string $signo='$'):string
{
	return $signo.number_format($valor,2, '.','');
}



//reset font
$pdf->SetFont('Arial','',14);
$total=0;
$total_cantidad=0;
$total_precio=0;
$total_por_cantidad2=0;
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//loop the data
foreach($result as $item){
	//write data using Row() method containing array of values.
	$total_precio=$item['precio']*$item['cantidad'];
	$item['ACTIVO']=$total_precio;
	$pdf->Row(Array(
		$item['id_venta'],
		$item['codigo'],
		$item[utf8_decode('descripcion')],
		SetCurrency($item['precio']),
		$item['cantidad'],
		$item['fecha_registro'],
		SetCurrency($item['ACTIVO']),

	));

$total=$total+$item['precio'];

$total_cantidad=$total_cantidad+$item['cantidad'];

$total_por_cantidad=$item['precio']*$item['cantidad'];
$total_por_cantidad2=$total_por_cantidad2+$total_por_cantidad;
}
//Operaciones para los ultimos totales

$pdf->Ln();

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(145,6,utf8_decode('Total'),1,0,'C',1);

$pdf->SetFont('Arial','B',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$pdf->Cell(30,6,SetCurrency($total),1,0,'C',1);
$pdf->Cell(28,6,$total_cantidad,1,0,'C',1);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(145,6,utf8_decode('Total por cantidad'),1,0,'C',1);

$pdf->SetFont('Arial','B',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$pdf->Cell(58,6,SetCurrency($total_por_cantidad2),1,0,'C',1);


//output the pdf
$pdf->Output('Reporte_Ventas.pdf', 'I');

?>