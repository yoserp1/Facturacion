<?php
include("ConexionComun.php");
include('fpdf.php');


class PDF extends FPDF {
    public $title;
    public $conexion;
    public $array_factura;
    public $array_factura_banco;
    function Header() {


        encabezado($this);
       

    }

    function Footer() {
	$this->SetFont('Arial','',9);     
	$this->SetY(-20);
	$this->Cell(0,0,utf8_decode('pagina web'),0,0,'C');        
    }

    function dwawCell($title,$data) {
        $width = 8;
        $this->SetFont('Arial','B',12);
        $y =  $this->getY() * 20;
        $x =  $this->getX();
        $this->SetFillColor(206,230,100);
        $this->MultiCell(175,8,$title,0,1,'L',0);
        $this->SetY($y);
        $this->SetFont('Arial','',12);
        $this->SetFillColor(206,230,172);
        $w=$this->GetStringWidth($title)+3;
        $this->SetX($x+$w);
        $this->SetFillColor(206,230,172);
        $this->MultiCell(175,8,$data,0,1,'J',0);

    }

    function ChapterBody() {

         $this->Ln(2);

         $this->datos = $this->getSolicitudes();

         $this->SetY($this->getY()*1.5);
         $this->SetFont('Arial','B',8);
         $this->SetFillColor(255, 255, 255);
         $this->SetWidths(array(60,140));
         $this->SetAligns(array("L","L"));
         $this->SetWidths(array(200));
         $this->SetAligns(array("L"));
         $this->SetFillColor(201, 199, 199);

         $this->Row(array(utf8_decode('Datos de la Solicitud')),1,1);
         $this->SetFillColor(255, 255, 255);
         $this->SetWidths(array(40,160));
         $this->Row(array(utf8_decode('Codigo Solicitud:'),utf8_decode($this->datos['co_solicitud'])),1,1);
         $this->Row(array(utf8_decode('Tramite Solicitado:'),utf8_decode($this->datos['tx_tipo_solicitud'])),1,1);
         $this->SetWidths(array(40,40,40,80));
         $this->Row(array(utf8_decode('Fecha de Recepción:'),$this->datos['fecha_recepcion'],utf8_decode('Fecha de Entrega Tentativa:'),$this->datos['fecha_entrega_est']),1,1);
//         $this->Row(array(),1,1);


         $this->SetWidths(array(200));
         $this->SetAligns(array("L"));
         $this->SetFillColor(201, 199, 199);
         $this->Ln();
         $this->Row(array(utf8_decode('Datos del Solicitante')),1,1);
         $this->SetFillColor(255, 255, 255);
         $this->SetWidths(array(20,30,30,120));
         $this->Row(array(utf8_decode('Cédula:'),$this->datos['cedula_rif'],utf8_decode('Nombre y Apellido:'),utf8_decode($this->datos['contribuyente'])),1,1);
         $this->SetWidths(array(20,30,30,120));
         $this->Row(array(utf8_decode('Telf. Movil:'),$this->datos['telef_movil'],utf8_decode('Telefono. Local:'),$this->datos['telef_habitacion']),1,1);

    //         $this->Row(array(utf8_decode('Cédula:'),$this->datos['cedula']),1,1);
         $this->SetWidths(array(20,180));
         $this->Row(array(utf8_decode('Dirección:'),utf8_decode($this->datos['tx_direccion'])),1,1);
         $this->Row(array(utf8_decode('Parroquia:'),utf8_decode($this->datos['tx_parroquia'])),1,1);
         $this->Ln();
         $this->SetWidths(array(200));
         $this->SetAligns(array("L"));
         $this->SetFillColor(201, 199, 199);
         $this->Row(array(utf8_decode('Observación')),1,1);
         $this->SetFillColor(255, 255, 255);
         $this->Row(array(utf8_decode($this->datos['observacion'])),1,1);

         $this->lista_requisitos = $this->getRequisitos();

         $this->SetWidths(array(200));
	 $this->SetFillColor(201, 199, 199);
         $this->Ln();
         $this->Row(array(utf8_decode('Requisitos Consignados')),1,1);

         foreach($this->lista_requisitos as $key => $campo){
           $this->SetFillColor(255,255,255);
           
           $this->SetAligns(array("L"));
           $this->Row(array(utf8_decode($campo['tx_requisito'])));
        }


	 $this->lista_requisitos_faltantes =$this->getRequisitosFaltantes();

         
		 $this->SetWidths(array(200));
		 $this->SetFillColor(201, 199, 199);
		 $this->Ln();
		 $this->Row(array(utf8_decode('Requisitos Faltantes')),1,1);

		 foreach($this->lista_requisitos_faltantes as $key => $campo){
		   $this->SetFillColor(255,255,255);
		   
		   $this->SetAligns(array("L"));
		   $this->Row(array(utf8_decode($campo['tx_requisito'])));
		}
	

         $this->ln();
         $this->SetWidths(array(100,100));
         $this->SetAligns(array("C","C"));
	 $this->SetFillColor(201, 199, 199);
         $this->Row(array(utf8_decode('Recibido Por:'),'Fima Solicitante'),1,1);
	 $this->SetFillColor(255,255,255);
         $this->Row(array(utf8_decode($this->datos['nombre_usuario']),''),1,1);

         $this->ln();
         $this->Cell(0,0,utf8_decode('En los 200 años del Bicentenario La Honestidad y la Eficiencia Nos Caracterizan'),0,0,'C');
         $this->ln();
	 $this->SetY($this->GetY()+5);
         $this->Cell(0,0,utf8_decode('Teléfono de Contacto: (0261)8957025'),0,0,'C');
//         $this->SetY($this->getY()+3);
//         $this->Cell(0,0,utf8_decode('Instituto Municipal de Geomática'),0,0,'C');


         

    }

    function ChapterTitle($num,$label) {
        $this->SetFont('Arial','',10);
        $this->SetFillColor(200,220,255);
        $this->Cell(0,6,"$label",0,1,'L',1);
        $this->Ln(8);
    }

    function SetTitle($title) {
        $this->title   = $title;
    }

    function PrintChapter() {
        $this->AddPage();
        $this->ChapterBody();
    }

    function getSolicitudes(){

          $conex = new ConexionComun();

          $sql = "select * from vista_solicitud where co_solicitud = ".$_GET['codigo'];

          $datosSol = $conex->ObtenerFilasBySqlSelect($sql);
          return  $datosSol[0];

    }

    function getRequisitos(){

	  $conex = new ConexionComun();

          $sql = "select distinct tx_requisito
		  FROM t16_solicitud_requisito as t1
   		  INNER JOIN t08_requisito as t2 ON t1.co_requisito = t2.co_requisito 
		  where t1.co_requisito = t1.co_requisito and co_solicitud = ".$_GET['codigo'];

          return $conex->ObtenerFilasBySqlSelect($sql);

    }

    function getRequisitosFaltantes()
    {
        $conex = new ConexionComun();
        $sql ="SELECT DISTINCT tx_requisito
		FROM  t16_solicitud_requisito as r,
			t15_solicitud as d,
			t10_requisito_tipo_solicitud as rs,
			t08_requisito as re
		WHERE       
			rs.co_tipo_solicitud = d.co_tipo_solicitud and
			re.co_requisito = rs.co_requisito and 
			rs.co_requisito not in (select distinct r.co_requisito from  t16_solicitud_requisito as r where r.co_solicitud = ".$_GET['codigo'].") and
			d.co_solicitud=r.co_solicitud and
			r.co_solicitud =".$_GET['codigo'];

        return $conex->ObtenerFilasBySqlSelect($sql);
		  
    }


}

$pdf=new PDF('P','mm','letter');
$pdf->AliasNbPages();
$pdf->PrintChapter();
$pdf->SetDisplayMode('default');
$pdf->Output();
?>
