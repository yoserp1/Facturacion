<?php

/**
 * proveedor actions.
 *
 * @package    facturacion
 * @subpackage proveedor
 * @author     renny
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class ProveedorActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('proveedor', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('proveedor', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeDetalle(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T06ProveedorPeer::CO_PROVEEDOR,$codigo);
        
        $stmt = T06ProveedorPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_proveedor"     => $campos["co_proveedor"],
                            "co_documento"     => $campos["co_documento"],
                            "tx_dni"     => $campos["tx_dni"],
                            "tx_nombre"     => $campos["tx_nombre"],
                            "tx_direccion"     => $campos["tx_direccion"],
                            "tx_telefono"     => $campos["tx_telefono"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_proveedor"     => "",
                            "co_documento"     => "",
                            "tx_dni"     => "",
                            "tx_nombre"     => "",
                            "tx_direccion"     => "",
                            "tx_telefono"     => "",
                    ));
    }

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T06ProveedorPeer::CO_PROVEEDOR,$codigo);
        
        $stmt = T06ProveedorPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_proveedor"     => $campos["co_proveedor"],
                            "co_documento"     => $campos["co_documento"],
                            "tx_dni"     => $campos["tx_dni"],
                            "tx_nombre"     => $campos["tx_nombre"],
                            "tx_direccion"     => $campos["tx_direccion"],
                            "tx_telefono"     => $campos["tx_telefono"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_proveedor"     => "",
                            "co_documento"     => "",
                            "tx_dni"     => "",
                            "tx_nombre"     => "",
                            "tx_direccion"     => "",
                            "tx_telefono"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_proveedor");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t06_proveedor = T06ProveedorPeer::retrieveByPk($codigo);
        $t06_proveedorForm = $this->getRequestParameter('t06_proveedor');
/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t06_proveedor->setCoDocumento($t06_proveedorForm["co_documento"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxDni($t06_proveedorForm["tx_dni"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxNombre($t06_proveedorForm["tx_nombre"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxDireccion($t06_proveedorForm["tx_direccion"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxTelefono($t06_proveedorForm["tx_telefono"]);
                
/*CAMPOS*/
        $t06_proveedor->save($con);
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
        $t06_proveedor = new T06Proveedor();
        $t06_proveedorForm = $this->getRequestParameter('t06_proveedor');

/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t06_proveedor->setCoDocumento($t06_proveedorForm["co_documento"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxDni($t06_proveedorForm["tx_dni"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxNombre($t06_proveedorForm["tx_nombre"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxDireccion($t06_proveedorForm["tx_direccion"]);
                                        
/*Campo tipo VARCHAR */
$t06_proveedor->setTxTelefono($t06_proveedorForm["tx_telefono"]);
                
/*CAMPOS*/

        $t06_proveedor->save($con);
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
	$codigo = $this->getRequestParameter("co_proveedor");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t06_proveedor = T06ProveedorPeer::retrieveByPk($codigo);			
	$t06_proveedor->delete($con);
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
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_documento!=""){$c1->add(T06ProveedorPeer::CO_DOCUMENTO,$co_documento);}
            
                                        if($tx_dni!=""){$c1->add(T06ProveedorPeer::TX_DNI,'%'.$tx_dni.'%',Criteria::LIKE);}
                
                                        if($tx_nombre!=""){$c1->add(T06ProveedorPeer::TX_NOMBRE,'%'.$tx_nombre.'%',Criteria::LIKE);}
                
                                        if($tx_direccion!=""){$c1->add(T06ProveedorPeer::TX_DIRECCION,'%'.$tx_direccion.'%',Criteria::LIKE);}
                
                                        if($tx_telefono!=""){$c1->add(T06ProveedorPeer::TX_TELEFONO,'%'.$tx_telefono.'%',Criteria::LIKE);}
                
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T06ProveedorPeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T06ProveedorPeer::CO_PROVEEDOR);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_documento!=""){$c->add(T06ProveedorPeer::CO_DOCUMENTO,$co_documento);}
    
                                        if($tx_dni!=""){$c->add(T06ProveedorPeer::TX_DNI,'%'.$tx_dni.'%',Criteria::LIKE);}
        
                                        if($tx_nombre!=""){$c->add(T06ProveedorPeer::TX_NOMBRE,'%'.$tx_nombre.'%',Criteria::LIKE);}
        
                                        if($tx_direccion!=""){$c->add(T06ProveedorPeer::TX_DIRECCION,'%'.$tx_direccion.'%',Criteria::LIKE);}
        
                                        if($tx_telefono!=""){$c->add(T06ProveedorPeer::TX_TELEFONO,'%'.$tx_telefono.'%',Criteria::LIKE);}
        
                    }
    $c->setIgnoreCase(true);

    $stmt = T06ProveedorPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_proveedor"     => trim($res["co_proveedor"]),
            "co_documento"     => trim($res["co_documento"]),
            "tx_dni"     => trim($res["tx_dni"]),
            "tx_nombre"     => trim($res["tx_nombre"]),
            "tx_direccion"     => trim($res["tx_direccion"]),
            "tx_telefono"     => trim($res["tx_telefono"]),
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
