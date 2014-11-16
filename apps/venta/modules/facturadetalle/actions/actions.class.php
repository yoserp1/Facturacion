<?php

/**
 * facturadetalle actions.
 *
 * @package    facturacion
 * @subpackage facturadetalle
 * @author     renny
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class FacturadetalleActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('facturadetalle', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('facturadetalle', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T13FacturaDetallePeer::CO_FACTURA_DETALLE,$codigo);
        
        $stmt = T13FacturaDetallePeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_factura_detalle"     => $campos["co_factura_detalle"],
                            "co_factura"     => $campos["co_factura"],
                            "co_producto"     => $campos["co_producto"],
                            "mo_unitario"     => $campos["mo_unitario"],
                            "nu_cantidad"     => $campos["nu_cantidad"],
                            "mo_iva"     => $campos["mo_iva"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_factura_detalle"     => "",
                            "co_factura"     => "",
                            "co_producto"     => "",
                            "mo_unitario"     => "",
                            "nu_cantidad"     => "",
                            "mo_iva"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_factura_detalle");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t13_factura_detalle = T13FacturaDetallePeer::retrieveByPk($codigo);
        $t13_factura_detalleForm = $this->getRequestParameter('t13_factura_detalle');
/*CAMPOS*/
                                        
/*Campo tipo BIGINT */
$t13_factura_detalle->setCoFactura($t13_factura_detalleForm["co_factura"]);
                                        
/*Campo tipo INTEGER */
$t13_factura_detalle->setCoProducto($t13_factura_detalleForm["co_producto"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setMoUnitario($t13_factura_detalleForm["mo_unitario"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setNuCantidad($t13_factura_detalleForm["nu_cantidad"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setMoIva($t13_factura_detalleForm["mo_iva"]);
                
/*CAMPOS*/
        $t13_factura_detalle->save($con);
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
        $t13_factura_detalle = new T13FacturaDetalle();
        $t13_factura_detalleForm = $this->getRequestParameter('t13_factura_detalle');

/*CAMPOS*/
                                        
/*Campo tipo BIGINT */
$t13_factura_detalle->setCoFactura($t13_factura_detalleForm["co_factura"]);
                                        
/*Campo tipo INTEGER */
$t13_factura_detalle->setCoProducto($t13_factura_detalleForm["co_producto"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setMoUnitario($t13_factura_detalleForm["mo_unitario"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setNuCantidad($t13_factura_detalleForm["nu_cantidad"]);
                                        
/*Campo tipo NUMERIC */
$t13_factura_detalle->setMoIva($t13_factura_detalleForm["mo_iva"]);
                
/*CAMPOS*/

        $t13_factura_detalle->save($con);
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
	$codigo = $this->getRequestParameter("co_factura_detalle");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t13_factura_detalle = T13FacturaDetallePeer::retrieveByPk($codigo);			
	$t13_factura_detalle->delete($con);
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
                $co_factura      =   $this->getRequestParameter("co_factura");
            $co_producto      =   $this->getRequestParameter("co_producto");
            $mo_unitario      =   $this->getRequestParameter("mo_unitario");
            $nu_cantidad      =   $this->getRequestParameter("nu_cantidad");
            $mo_iva      =   $this->getRequestParameter("mo_iva");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_factura!=""){$c1->add(T13FacturaDetallePeer::CO_FACTURA,$co_factura);}
            
                                            if($co_producto!=""){$c1->add(T13FacturaDetallePeer::CO_PRODUCTO,$co_producto);}
            
                                            if($mo_unitario!=""){$c1->add(T13FacturaDetallePeer::MO_UNITARIO,$mo_unitario);}
            
                                            if($nu_cantidad!=""){$c1->add(T13FacturaDetallePeer::NU_CANTIDAD,$nu_cantidad);}
            
                                            if($mo_iva!=""){$c1->add(T13FacturaDetallePeer::MO_IVA,$mo_iva);}
            
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T13FacturaDetallePeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T13FacturaDetallePeer::CO_FACTURA_DETALLE);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_factura!=""){$c->add(T13FacturaDetallePeer::CO_FACTURA,$co_factura);}
    
                                            if($co_producto!=""){$c->add(T13FacturaDetallePeer::CO_PRODUCTO,$co_producto);}
    
                                            if($mo_unitario!=""){$c->add(T13FacturaDetallePeer::MO_UNITARIO,$mo_unitario);}
    
                                            if($nu_cantidad!=""){$c->add(T13FacturaDetallePeer::NU_CANTIDAD,$nu_cantidad);}
    
                                            if($mo_iva!=""){$c->add(T13FacturaDetallePeer::MO_IVA,$mo_iva);}
    
                    }
    $c->setIgnoreCase(true);

    $stmt = T13FacturaDetallePeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_factura_detalle"     => trim($res["co_factura_detalle"]),
            "co_factura"     => trim($res["co_factura"]),
            "co_producto"     => trim($res["co_producto"]),
            "mo_unitario"     => trim($res["mo_unitario"]),
            "nu_cantidad"     => trim($res["nu_cantidad"]),
            "mo_iva"     => trim($res["mo_iva"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                    //modelo fk t12_factura.CO_FACTURA
    public function executeStorefkcofactura(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T12FacturaPeer::doSelectStmt($c);
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
                    //modelo fk t07_producto.CO_PRODUCTO
    public function executeStorefkcoproducto(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T07ProductoPeer::doSelectStmt($c);
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
