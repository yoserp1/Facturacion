<?php

/**
 * autoFactura actions.
 * NombreClaseModel(T12Factura)
 * NombreTabla(t12_factura)
 * @package    ##PROJECT_NAME##
 * @subpackage autoFactura
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 16948 2014-07-30 18:31:28 fabien $
 */
class autoFacturaActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('factura', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('factura', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T12FacturaPeer::CO_FACTURA,$codigo);
        
        $stmt = T12FacturaPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_factura"     => $campos["co_factura"],
                            "co_cliente"     => $campos["co_cliente"],
                            "fe_factura"     => $campos["fe_factura"],
                            "nu_iva"     => $campos["nu_iva"],
                            "mo_neto"     => $campos["mo_neto"],
                            "mo_iva"     => $campos["mo_iva"],
                            "mo_total"     => $campos["mo_total"],
                            "co_usuario"     => $campos["co_usuario"],
                            "co_tipo_factura"     => $campos["co_tipo_factura"],
                            "fecha_creacion"     => $campos["fecha_creacion"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_factura"     => "",
                            "co_cliente"     => "",
                            "fe_factura"     => "",
                            "nu_iva"     => "",
                            "mo_neto"     => "",
                            "mo_iva"     => "",
                            "mo_total"     => "",
                            "co_usuario"     => "",
                            "co_tipo_factura"     => "",
                            "fecha_creacion"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_factura");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t12_factura = T12FacturaPeer::retrieveByPk($codigo);
        $t12_facturaForm = $this->getRequestParameter('t12_factura');
/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoCliente($t12_facturaForm["co_cliente"]);
                                                
/*Campo tipo DATE */
list($dia, $mes, $anio) = explode("/",$t12_facturaForm["fe_factura"]);
$fecha = $anio."-".$mes."-".$dia;
$t12_factura->setFeFactura($fecha);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setNuIva($t12_facturaForm["nu_iva"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoNeto($t12_facturaForm["mo_neto"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoIva($t12_facturaForm["mo_iva"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoTotal($t12_facturaForm["mo_total"]);
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoUsuario($t12_facturaForm["co_usuario"]);
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoTipoFactura($t12_facturaForm["co_tipo_factura"]);
                                        
/*Campo tipo TIMESTAMP */
list($dia, $mes, $anio) = explode("/",$t12_facturaForm["fecha_creacion"]);
$fecha = $anio."-".$mes."-".$dia;
$t12_factura->setFechaCreacion($fecha);
                
/*CAMPOS*/
        $t12_factura->save($con);
        $this->data = json_encode(array(
                    "success" => true,
                    "msg" => 'Modificación realizada exitosamente'
                ));
        $con->commit();
      }catch (PropelException $e)
      {
        $con->rollback();
        $this->data = json_encode(array(
            "success" => false,
            "msg" =>  $e->getMessage()
        ));
      }
    }else{
        $con = Propel::getConnection();
        try{
        $con->beginTransaction();
        $t12_factura = new T12Factura();
        $t12_facturaForm = $this->getRequestParameter('t12_factura');

/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoCliente($t12_facturaForm["co_cliente"]);
                                                
/*Campo tipo DATE */
list($dia, $mes, $anio) = explode("/",$t12_facturaForm["fe_factura"]);
$fecha = $anio."-".$mes."-".$dia;
$t12_factura->setFeFactura($fecha);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setNuIva($t12_facturaForm["nu_iva"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoNeto($t12_facturaForm["mo_neto"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoIva($t12_facturaForm["mo_iva"]);
                                        
/*Campo tipo NUMERIC */
$t12_factura->setMoTotal($t12_facturaForm["mo_total"]);
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoUsuario($t12_facturaForm["co_usuario"]);
                                        
/*Campo tipo INTEGER */
$t12_factura->setCoTipoFactura($t12_facturaForm["co_tipo_factura"]);
                                        
/*Campo tipo TIMESTAMP */
list($dia, $mes, $anio) = explode("/",$t12_facturaForm["fecha_creacion"]);
$fecha = $anio."-".$mes."-".$dia;
$t12_factura->setFechaCreacion($fecha);
                
/*CAMPOS*/

        $t12_factura->save($con);
            $this->data = json_encode(array(
                "success" => true,
                "msg" => 'Proceso realizado exitosamente.'
            ));
            $con->commit($con);
        }catch (Exception $e){
            $con->rollback();
            $this->data = json_encode(array(
                "success" => false,
                "msg" =>  $e->getMessage()
            ));
        }
    }
  }

  public function executeEliminar(sfWebRequest $request)
  {
	$codigo = $this->getRequestParameter("co_factura");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t12_factura = T12FacturaPeer::retrieveByPk($codigo);			
	$t12_factura->delete($con);
		$this->data = json_encode(array(
			    "success" => true,
			    "msg" => 'Registro Borrado con exito!'
		));
	$con->commit();
	}catch (PropelException $e)
	{
	$con->rollback();
		$this->data = json_encode(array(
		    "success" => false,
//		    "msg" =>  $e->getMessage()
		    "msg" => 'Este registro no se puede borrar porque <br>se encuentra asociado a otros registros'
		));
	}
  }

  public function executeLista(sfWebRequest $request)
  {

  }

  public function executeStorelista(sfWebRequest $request)
  {
    $paginar    =   $this->getRequestParameter("paginar");
    $limit      =   $this->getRequestParameter("limit",20);
    $start      =   $this->getRequestParameter("start",0);
                $co_cliente      =   $this->getRequestParameter("co_cliente");
            $fe_factura      =   $this->getRequestParameter("fe_factura");
            $nu_iva      =   $this->getRequestParameter("nu_iva");
            $mo_neto      =   $this->getRequestParameter("mo_neto");
            $mo_iva      =   $this->getRequestParameter("mo_iva");
            $mo_total      =   $this->getRequestParameter("mo_total");
            $co_usuario      =   $this->getRequestParameter("co_usuario");
            $co_tipo_factura      =   $this->getRequestParameter("co_tipo_factura");
            $fecha_creacion      =   $this->getRequestParameter("fecha_creacion");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_cliente!=""){$c1->add(T12FacturaPeer::CO_CLIENTE,$co_cliente);}
            
                                            
        if($fe_factura!=""){
    list($dia, $mes,$anio) = explode("/",$fe_factura);
    $fecha = $anio."-".$mes."-".$dia;
    $c1->add(T12FacturaPeer::FE_FACTURA,$fecha);
    }
                                            if($nu_iva!=""){$c1->add(T12FacturaPeer::NU_IVA,$nu_iva);}
            
                                            if($mo_neto!=""){$c1->add(T12FacturaPeer::MO_NETO,$mo_neto);}
            
                                            if($mo_iva!=""){$c1->add(T12FacturaPeer::MO_IVA,$mo_iva);}
            
                                            if($mo_total!=""){$c1->add(T12FacturaPeer::MO_TOTAL,$mo_total);}
            
                                            if($co_usuario!=""){$c1->add(T12FacturaPeer::CO_USUARIO,$co_usuario);}
            
                                            if($co_tipo_factura!=""){$c1->add(T12FacturaPeer::CO_TIPO_FACTURA,$co_tipo_factura);}
            
                                            
        if($fecha_creacion!=""){
    list($dia, $mes,$anio) = explode("/",$fecha_creacion);
    $fecha = $anio."-".$mes."-".$dia;
    $c1->add(T12FacturaPeer::FECHA_CREACION,$fecha);
    }
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T12FacturaPeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T12FacturaPeer::CO_FACTURA);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_cliente!=""){$c->add(T12FacturaPeer::CO_CLIENTE,$co_cliente);}
    
                                    
        if($fe_factura!=""){
    list($dia, $mes,$anio) = explode("/",$fe_factura);
    $fecha = $anio."-".$mes."-".$dia;
    $c->add(T12FacturaPeer::FE_FACTURA,$fecha);
    }
                                            if($nu_iva!=""){$c->add(T12FacturaPeer::NU_IVA,$nu_iva);}
    
                                            if($mo_neto!=""){$c->add(T12FacturaPeer::MO_NETO,$mo_neto);}
    
                                            if($mo_iva!=""){$c->add(T12FacturaPeer::MO_IVA,$mo_iva);}
    
                                            if($mo_total!=""){$c->add(T12FacturaPeer::MO_TOTAL,$mo_total);}
    
                                            if($co_usuario!=""){$c->add(T12FacturaPeer::CO_USUARIO,$co_usuario);}
    
                                            if($co_tipo_factura!=""){$c->add(T12FacturaPeer::CO_TIPO_FACTURA,$co_tipo_factura);}
    
                                    
        if($fecha_creacion!=""){
    list($dia, $mes,$anio) = explode("/",$fecha_creacion);
    $fecha = $anio."-".$mes."-".$dia;
    $c->add(T12FacturaPeer::FECHA_CREACION,$fecha);
    }
                    }
    $c->setIgnoreCase(true);

    $stmt = T12FacturaPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_factura"     => trim($res["co_factura"]),
            "co_cliente"     => trim($res["co_cliente"]),
            "fe_factura"     => trim($res["fe_factura"]),
            "nu_iva"     => trim($res["nu_iva"]),
            "mo_neto"     => trim($res["mo_neto"]),
            "mo_iva"     => trim($res["mo_iva"]),
            "mo_total"     => trim($res["mo_total"]),
            "co_usuario"     => trim($res["co_usuario"]),
            "co_tipo_factura"     => trim($res["co_tipo_factura"]),
            "fecha_creacion"     => trim($res["fecha_creacion"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                    //modelo fk t10_cliente.CO_CLIENTE
    public function executeStorefkcocliente(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T10ClientePeer::doSelectStmt($c);
        $registros = array();
        while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
            $registros[] = $reg;
        }

        $this->data = json_encode(array(
            "success"   =>  true,
            "total"     =>  count($registros),
            "data"      =>  $registros
            ));
        $this->setTemplate('store');
    }
                                                                                            //modelo fk t11_tipo_factura.CO_TIPO_FACTURA
    public function executeStorefkcotipofactura(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T11TipoFacturaPeer::doSelectStmt($c);
        $registros = array();
        while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
            $registros[] = $reg;
        }

        $this->data = json_encode(array(
            "success"   =>  true,
            "total"     =>  count($registros),
            "data"      =>  $registros
            ));
        $this->setTemplate('store');
    }
                    


}
