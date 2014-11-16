<?php

require_once("adodb5/adodb.inc.php");
define("USUARIO","postgres");
define("CLAVE","1234");
define("BASEDEDATOS","basededatos");
define("SERVIDOR","localhost");
define("GESTOR_DATABASE","postgres"); //mysql, postgrest

class ConexionComun{
    protected $rCampos = "";
    protected $db;
    protected $rs;
    protected $instruccion;
    public    $errorTransaccion =1; 

    function __construct(){
        $this->db = NewADOConnection(GESTOR_DATABASE);
        $this->db->Connect(SERVIDOR,USUARIO,CLAVE,BASEDEDATOS);
        $this->db->SetFetchMode(ADODB_FETCH_ASSOC);
        $this->db->debug = false;
    }

     /**
     * Retorna la cantidad de filas que genero la consulta sql.
     * @return int
     */
    function getFilas(){
    	if(!$this->rs){
            return 0;
        }else{
            return $this->rs->RecordCount();
        }
    }

    /**
     * Función para realizar consultas sql a la base de datos.
     * @param string $sql Consulta SQL que se desea veriticar. 
     * @return string
     */
    function ObtenerFilasBySqlSelect($sql){
        $this->instruccion = $sql;
        $this->rs = $this->db->Execute($this->instruccion);
        if(!$this->rs){
            //return echo "Error: ".$this->db->ErrorMsg();
            //$this->rCampos = -1;
            return "";
        }else{
            $this->rCampos = $this->rs->GetRows();
        }
        return $this->rCampos;
    }

    
    }

    function mes($nu_mes){

        $mes['01']='Enero';
        $mes['02']='Febrero';
        $mes['03']='Marzo';
        $mes['04']='Abril';
        $mes['05']='Mayo';
        $mes['06']='Junio';
        $mes['07']='Julio';
        $mes['08']='Agosto';
        $mes['09']='Septiembre';
        $mes['10']='Octubre';
        $mes['11']='Noviembre';
        $mes['12']='Diciembre';

        return $mes[$nu_mes];

    }

    function encabezado($pdf,$h='v'){

//	$pdf->Image("imagenes/CORPORACION.jpg", 8, 8,35);
        
//        if($h=='v'){$pdf->Image("imagenes/sedebat.png", 190, 8,20);}
 //       if($h=='h'){$pdf->Image("imagenes/sedebat.png", 245, 7,18);}

        $pdf->SetFont('Arial','B',9);
       

        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(10.5);
        $pdf->Cell(0,0,utf8_decode('NOMBRE DE LA EMPRESA'),0,0,'C');
        $pdf->Ln(4);
        $pdf->Cell(0,0,utf8_decode('UBICACION'),0,0,'C');
        $pdf->Ln(4);
        $pdf->Cell(0,0,utf8_decode('FACTURA'),0,0,'C');
	if($h=='h'){
        $x=60;
	}else{
	$x=30;
	}
//        $pdf->Image("imagenes/GEOMATICA.JPG", $x, 20,25);
 //       $x=$x+27;
 //       $pdf->Image("imagenes/IMASUR.JPG", $x, 22,15);
//        $x=$x+18;
 //       $pdf->Image("imagenes/IPMGAS.jpg", $x, 24,15);
 //       $x=$x+16;
//        $pdf->Image("imagenes/logo_rentas.jpg", $x, 21,29);
 //       $x=$x+27;
 //       $pdf->Image("imagenes/IMVITRA.jpg", $x, 23,18);
  //      $x=$x+22;
 //       $pdf->Image("imagenes/BOMBEROS.JPG", $x, 24,11);
  //      $x=$x+15;
 //       $pdf->Image("imagenes/logo.jpg", $x, 23,15);

//	  $x=$x+17;
//        $pdf->Image("imagenes/sindicaturamunicipal.JPG",$x,26.5,17);

      
//        $x=$x+15;
//	$pdf->Image("imagenes/sindicaturamunicipal.JPG",$x,25,23);
        $pdf->Ln(3);
        return $pdf;
    }

 

?>
