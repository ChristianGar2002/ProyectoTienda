<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la libreria FPD

	include('pdf_mc_table_venta.php');

	include_once("fpdf184/fpdf.php");

if($_GET['id_venta']){
	$dato = $_GET['id_venta'];

//Cuerpo de la tabla	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM ventas WHERE id_venta = '{$dato}'") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM ventas WHERE id_venta = '{$dato}'");
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

$pdf->SetFont('Arial', 'B', 16);
		$pdf->SetY(33);
		//Movemos a la derecha la imagen
		$pdf->Cell(6);
		//Cuadro de titulo
		$pdf->Cell(30,10,utf8_decode("Venta número: "),0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(33);
		//Movemos a la derecha la imagen
		$pdf->Cell(27);
		//Cuadro de titulo
		$pdf->Cell(30,10,$dato,0,0,'C');

		$pdf->Ln(10);

$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(70,85,40,30,50));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C'));

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
$pdf->Cell(70,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(85,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(40,6,"Precio",1,0,'C',1);
$pdf->Cell(30,6,"Cantidad",1,0,'C',1);
$pdf->Cell(50,6,"Fecha de registro",1,0,'C',1);

$pdf->Ln();

//Funcion para el formato de precios y totales

function SetCurrency(float $valor, string $signo='$'):string
{
	return $signo.number_format($valor,2, '.','');
}



//reset font
$pdf->SetFont('Arial','',14);
$total_2=0;
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//loop the data
foreach($result as $item){
	//write data using Row() method containing array of values.

	$pdf->Row(Array(
		$item['codigo'],
		$item[utf8_decode('descripcion')],
		SetCurrency($item['precio']),
		$item['cantidad'],
		$item['fecha_registro'],

	));

$total=$item['precio']*$item['cantidad'];
$total_2=$total_2+$total;
}
//Operaciones para los ultimos totales

$pdf->Ln();

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(30,6,utf8_decode('Total'),1,0,'C',1);

$pdf->SetFont('Arial','',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(50,6,SetCurrency($total_2),1,0,'C',1);


//output the pdf
$pdf->Output('Reporte_Venta_'.$dato.'.pdf', 'I');
}
?>