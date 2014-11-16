<?php

/**
 * cliente actions.
 *
 * @package    facturacion
 * @subpackage cliente
 * @author     renny
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class ClienteActions extends sfActions
{

  public function executeVerificar(sfWebRequest $request)
  {
  
    $co_documento        = $this->getRequestParameter('co_documento');
    $tx_dni       = $this->getRequestParameter('tx_dni');

    $c = new Criteria();
    $c->add(T10ClientePeer::CO_DOCUMENTO,$co_documento);
    $c->add(T10ClientePeer::TX_DNI,'%'.$tx_dni.'%',Criteria::LIKE);
    $stmt = T10ClientePeer::doSelectStmt($c);

    $registros = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->data = json_encode(array(
        "success"   => true,
        "data"      => $registros
    ));
    $this->setTemplate('store');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('cliente', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('cliente', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeFiltrofactura(sfWebRequest $request)
  {
	$this->data = json_encode(array(
		"co_cliente"     => $this->getRequestParameter("co_cliente"),
	));
  }

  public function executeDetalle(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T10ClientePeer::CO_CLIENTE,$codigo);
        
        $stmt = T10ClientePeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_cliente"     => $campos["co_cliente"],
                            "co_documento"     => $campos["co_documento"],
                            "tx_dni"     => $campos["tx_dni"],
                            "tx_nombre"     => $campos["tx_nombre"],
                            "tx_direccion"     => $campos["tx_direccion"],
                            "tx_telefono"     => $campos["tx_telefono"],
                            "nu_limite_credito"     => $campos["nu_limite_credito"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_cliente"     => "",
                            "co_documento"     => "",
                            "tx_dni"     => "",
                            "tx_nombre"     => "",
                            "tx_direccion"     => "",
                            "tx_telefono"     => "",
                            "nu_limite_credito"     => "",
                    ));
    }

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T10ClientePeer::CO_CLIENTE,$codigo);
        
        $stmt = T10ClientePeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_cliente"     => $campos["co_cliente"],
                            "co_documento"     => $campos["co_documento"],
                            "tx_dni"     => $campos["tx_dni"],
                            "tx_nombre"     => $campos["tx_nombre"],
                            "tx_direccion"     => $campos["tx_direccion"],
                            "tx_telefono"     => $campos["tx_telefono"],
                            "nu_limite_credito"     => $campos["nu_limite_credito"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_cliente"     => "",
                            "co_documento"     => "",
                            "tx_dni"     => "",
                            "tx_nombre"     => "",
                            "tx_direccion"     => "",
                            "tx_telefono"     => "",
                            "nu_limite_credito"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_cliente");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t10_cliente = T10ClientePeer::retrieveByPk($codigo);
        $t10_clienteForm = $this->getRequestParameter('t10_cliente');
/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t10_cliente->setCoDocumento($t10_clienteForm["co_documento"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxDni($t10_clienteForm["tx_dni"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxNombre($t10_clienteForm["tx_nombre"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxDireccion($t10_clienteForm["tx_direccion"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxTelefono($t10_clienteForm["tx_telefono"]);
                                        
/*Campo tipo NUMERIC */
$t10_cliente->setNuLimiteCredito($t10_clienteForm["nu_limite_credito"]);
                
/*CAMPOS*/
        $t10_cliente->save($con);
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
        $t10_cliente = new T10Cliente();
        $t10_clienteForm = $this->getRequestParameter('t10_cliente');

/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t10_cliente->setCoDocumento($t10_clienteForm["co_documento"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxDni($t10_clienteForm["tx_dni"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxNombre($t10_clienteForm["tx_nombre"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxDireccion($t10_clienteForm["tx_direccion"]);
                                        
/*Campo tipo VARCHAR */
$t10_cliente->setTxTelefono($t10_clienteForm["tx_telefono"]);
                                        
/*Campo tipo NUMERIC */
$t10_cliente->setNuLimiteCredito($t10_clienteForm["nu_limite_credito"]);
                
/*CAMPOS*/

        $t10_cliente->save($con);
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
	$codigo = $this->getRequestParameter("co_cliente");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t10_cliente = T10ClientePeer::retrieveByPk($codigo);			
	$t10_cliente->delete($con);
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
                $co_documento      =   $this->getRequestParameter("co_documento");
            $tx_dni      =   $this->getRequestParameter("tx_dni");
            $tx_nombre      =   $this->getRequestParameter("tx_nombre");
            $tx_direccion      =   $this->getRequestParameter("tx_direccion");
            $tx_telefono      =   $this->getRequestParameter("tx_telefono");
            $nu_limite_credito      =   $this->getRequestParameter("nu_limite_credito");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_documento!=""){$c1->add(T10ClientePeer::CO_DOCUMENTO,$co_documento);}
            
                                        if($tx_dni!=""){$c1->add(T10ClientePeer::TX_DNI,'%'.$tx_dni.'%',Criteria::LIKE);}
                
                                        if($tx_nombre!=""){$c1->add(T10ClientePeer::TX_NOMBRE,'%'.$tx_nombre.'%',Criteria::LIKE);}
                
                                        if($tx_direccion!=""){$c1->add(T10ClientePeer::TX_DIRECCION,'%'.$tx_direccion.'%',Criteria::LIKE);}
                
                                        if($tx_telefono!=""){$c1->add(T10ClientePeer::TX_TELEFONO,'%'.$tx_telefono.'%',Criteria::LIKE);}
                
                                            if($nu_limite_credito!=""){$c1->add(T10ClientePeer::NU_LIMITE_CREDITO,$nu_limite_credito);}
            
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T10ClientePeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T10ClientePeer::CO_CLIENTE);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_documento!=""){$c->add(T10ClientePeer::CO_DOCUMENTO,$co_documento);}
    
                                        if($tx_dni!=""){$c->add(T10ClientePeer::TX_DNI,'%'.$tx_dni.'%',Criteria::LIKE);}
        
                                        if($tx_nombre!=""){$c->add(T10ClientePeer::TX_NOMBRE,'%'.$tx_nombre.'%',Criteria::LIKE);}
        
                                        if($tx_direccion!=""){$c->add(T10ClientePeer::TX_DIRECCION,'%'.$tx_direccion.'%',Criteria::LIKE);}
        
                                        if($tx_telefono!=""){$c->add(T10ClientePeer::TX_TELEFONO,'%'.$tx_telefono.'%',Criteria::LIKE);}
        
                                            if($nu_limite_credito!=""){$c->add(T10ClientePeer::NU_LIMITE_CREDITO,$nu_limite_credito);}
    
                    }
    $c->setIgnoreCase(true);

    $stmt = T10ClientePeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_cliente"     => trim($res["co_cliente"]),
            "co_documento"     => trim($res["co_documento"]),
            "tx_dni"     => trim($res["tx_dni"]),
            "tx_nombre"     => trim($res["tx_nombre"]),
            "tx_direccion"     => trim($res["tx_direccion"]),
            "tx_telefono"     => trim($res["tx_telefono"]),
            "nu_limite_credito"     => trim($res["nu_limite_credito"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

  public function executeFactura(sfWebRequest $request)
  {
	$this->data = json_encode(array(
		"co_cliente"     => $this->getRequestParameter("co_cliente"),
	));
  }

  public function executeStorelistafactura(sfWebRequest $request)
  {
    $paginar    =   $this->getRequestParameter("paginar");
    $limit      =   $this->getRequestParameter("limit",10);
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
		$c1->add(T12FacturaPeer::CO_CLIENTE,$co_cliente);
		$c1->addJoin(T12FacturaPeer::CO_TIPO_FACTURA, T11TipoFacturaPeer::CO_TIPO_FACTURA);
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
		$c->add(T12FacturaPeer::CO_CLIENTE,$co_cliente);
		$c->clearSelectColumns();
        	$c->addSelectColumn(T12FacturaPeer::CO_FACTURA);
        	$c->addSelectColumn(T12FacturaPeer::CO_CLIENTE);
        	$c->addSelectColumn(T12FacturaPeer::FE_FACTURA);
        	$c->addSelectColumn(T12FacturaPeer::NU_IVA);
        	$c->addSelectColumn(T12FacturaPeer::MO_NETO);
        	$c->addSelectColumn(T12FacturaPeer::MO_IVA);
        	$c->addSelectColumn(T12FacturaPeer::MO_TOTAL);
        	$c->addSelectColumn(T12FacturaPeer::CO_USUARIO);
        	$c->addSelectColumn(T12FacturaPeer::FECHA_CREACION);
        	$c->addSelectColumn(T11TipoFacturaPeer::TX_TIPO_FACTURA);
		$c->addJoin(T12FacturaPeer::CO_TIPO_FACTURA, T11TipoFacturaPeer::CO_TIPO_FACTURA);
    $stmt = T12FacturaPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_factura"     => trim($res["co_factura"]),
            "co_cliente"     => trim($res["co_cliente"]),
            "fe_factura"     => trim(date_format(date_create($res["fe_factura"]),'d/m/Y')),
            "nu_iva"     => trim($res["nu_iva"]),
            "mo_neto"     => trim($res["mo_neto"]),
            "mo_iva"     => trim($res["mo_iva"]),
            "mo_total"     => trim($res["mo_total"]),
            "co_usuario"     => trim($res["co_usuario"]),
            "co_tipo_factura"     => trim($res["tx_tipo_factura"]),
            "fecha_creacion"     => trim($res["fecha_creacion"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                    //modelo fk t05_documento.CO_DOCUMENTO
    public function executeStorefkcodocumento(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T05DocumentoPeer::doSelectStmt($c);
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
