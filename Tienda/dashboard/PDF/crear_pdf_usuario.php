<?php 
	//Incluir el fichero de conexion
	include("conexion.php");

	//Incluir la clase pdf_mc_table
	include('pdf_mc_table.php');

	//Incluir la libreria FPD
	include_once("fpdf184/fpdf.php");

//Cuerpo de la tabla, conexión y consulta a la base de datos	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM usuarios") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM usuarios");
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

		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(70);
		//Cuadro de titulo
		$pdf->Cell(100,10,"Fecha: ",0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(90);
		//Cuadro de titulo
		$pdf->Cell(100,10,$fecha_registro,0,0,'C');

		$pdf->Ln(10);

$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(12,45,50,50,33,50,43));

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

//Campos de la tabla
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(12,6,"ID",1,0,'C',1);
$pdf->Cell(45,6,"Nombre completo",1,0,'C',1);
$pdf->Cell(50,6,"Nombre de usuario",1,0,'C',1);
$pdf->Cell(50,6,"Correo",1,0,'C',1);
$pdf->Cell(33,6,"Rol",1,0,'C',1);
$pdf->Cell(50,6,utf8_decode('Contraseña'),1,0,'C',1);
$pdf->Cell(43,6,"Fecha de registro",1,0,'C',1);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

//Datos de la tabla
foreach($result as $item){

	$pdf->Row(Array(
		$item['id'],
		$item[utf8_decode('name')],
		$item['username'],
		$item[utf8_decode('correo')],
		$item['rol'],
		$item['password'],
		$item['fecha_registro'],

	));

	
}

//output the pdf
$pdf->Output('Reporte_Usuarios.pdf', 'I');

?>