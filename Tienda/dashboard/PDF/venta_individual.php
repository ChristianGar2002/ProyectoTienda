<?php  
  session_start();
  //Incluimos el archivo de conexion a la BD.
  include_once('../bd/conexion.php');

  if (!isset($_SESSION['ID'])) {
    header("location: ../login/iniciar_sesion.php");
    exit();
  }

?>
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');
?>
<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la clase pdf_mc_table
	include('pdf_mc_table_ticket.php');
	//Incluir la libreria FPD
	include_once("fpdf184/fpdf.php");

//Recibo el id de venta
if($_GET['id_venta']){
	$dato = $_GET['id_venta'];

//Conexión de la base de datos
	$db = new dbConexion();
	$connString = $db->getConexion();

	//Consulta para extraer los datos de la venta
	$result = mysqli_query($connString, "SELECT * FROM ventas WHERE id_venta = '{$dato}'") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM ventas WHERE id_venta = '{$dato}'");
	$fecha_registro= date("d/m/y");

	

//make new object
$pdf = new PDF_MC_Table('P','mm',array(90,150));

//add page, set font

//Header
	$pdf -> AddPage();

	$pdf -> SetAutoPageBreak(true,20);

	//Footer
	$pdf->AliasNbPages();

//Datos del ticket
$pdf->SetFont('Arial', 'B', 10);

		$pdf->SetY(12);
		//Movemos a la derecha la imagen
		$pdf->Cell(13);
		//Cuadro de titulo
		$pdf->Cell(50,10,"TICKET DE COMPRA",0,0,'C');

//Direccion
$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(19);
		//Movemos a la derecha la imagen
		$pdf->Cell(10);
		//Cuadro de titulo
		$pdf->Cell(55,10,utf8_decode("Dirección: Col.Morelos, Calle.Manuel Avila"),0,0,'C');

//Telefono
$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(17);
		//Cuadro de titulo
		$pdf->Cell(40,10,utf8_decode("Telefono: 55523-528654"),0,0,'C');

//Vendedor
$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(31);
		//Movemos a la derecha la imagen
		$pdf->Cell(26);
		//Cuadro de titulo
		$pdf->Cell(13,10,utf8_decode("Vendedor: "),0,0,'C');

//Vendedor
$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(31);
		//Movemos a la derecha la imagen
		$pdf->Cell(34);
		//Cuadro de titulo
		$pdf->Cell(20,10,utf8_decode(($_SESSION['USERNAME'])),0,0,'C');

//Fecha de la venta
$query = mysqli_num_rows($result);
$data = mysqli_fetch_assoc($result);

//Fecha
$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(39);
		//Movemos a la derecha la imagen
		$pdf->Cell(1);
		//Cuadro de titulo
		$pdf->Cell(8,10,"Fecha: ",0,0,'C');

$pdf->SetFont('Arial', '', 8);
		$pdf->SetY(39);
		//Movemos a la derecha la imagen
		$pdf->Cell(12);
		//Cuadro de titulo
		$pdf->Cell(10,10,$data['fecha_registro'],0,0,'C');


$pdf->SetFont('Arial', '', 8);

		$pdf->SetY(44);
		//Movemos a la derecha la imagen
		$pdf->Cell(8);
		//Cuadro de titulo
		$pdf->Cell(8,10,utf8_decode("Número de venta: "),0,0,'C');

$pdf->SetFont('Arial', 'B', 8);

		$pdf->SetY(44);
		//Movemos a la derecha la imagen
		$pdf->Cell(20);
		//Cuadro de titulo
		$pdf->Cell(10,10,utf8_decode($dato),0,0,'C');

//Fecha
$pdf->SetFont('Arial', '', 8);

		$pdf->Ln(10);

$pdf->SetFont('Arial','',10);

//set width for each column (6 columns)
$pdf->SetWidths(Array(18,23,15,15));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//add table heading using standard cells
//set font to bold
//$prueba=['ID',''];

//$pdf->Row(Array(

	//$prueba[0],
	//));

//Encabezados de la tabla
$pdf->SetY(53);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(18,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(23,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(15,6,"Cantidad",1,0,'C',1);
$pdf->Cell(15,6,"Precio",1,0,'C',1);


$pdf->Ln();

//Funcion para el formato de precios y totales

function SetCurrency(float $valor, string $signo='$'):string
{
	return $signo.number_format($valor,2, '.','');
}

//reset font
$pdf->SetY(59);
$pdf->SetFont('Arial','',8);
$total_2=0;
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

//Datos de la venta
foreach($result as $item){
	//write data using Row() method containing array of values.

	$pdf->Row(Array(
		$item['codigo'],
		$item[utf8_decode('descripcion')],
		$item['cantidad'],
		SetCurrency($item['precio']),

	));

$total=$item['precio']*$item['cantidad'];
$total_2=$total_2+$total;
}
//Operaciones para los ultimos totales

$pdf->Ln();

$pdf->Setx(51);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(10,6,utf8_decode('Total'),1,0,'C',1);

$pdf->SetFont('Arial','',8);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(20,6,SetCurrency($total_2),1,0,'C',1);

$pdf->Ln();
$pdf->Ln();

//Gracias
$pdf->SetFont('Arial', 'B', 10);
$pdf->Setx(37);
$pdf->Cell(13,6,"Gracias por su compra",0,0,'C',1);

//output the pdf
$pdf->Output('ticket_'.$dato.'.pdf','I');
	}
?>