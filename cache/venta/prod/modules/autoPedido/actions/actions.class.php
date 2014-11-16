<?php

/**
 * autoPedido actions.
 * NombreClaseModel(T08Pedido)
 * NombreTabla(t08_pedido)
 * @package    ##PROJECT_NAME##
 * @subpackage autoPedido
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 16948 2014-10-15 22:40:14 fabien $
 */
class autoPedidoActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('pedido', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('pedido', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T08PedidoPeer::CO_PEDIDO,$codigo);
        
        $stmt = T08PedidoPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_pedido"     => $campos["co_pedido"],
                            "co_proveedor"     => $campos["co_proveedor"],
                            "fe_pedido"     => $campos["fe_pedido"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_pedido"     => "",
                            "co_proveedor"     => "",
                            "fe_pedido"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_pedido");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t08_pedido = T08PedidoPeer::retrieveByPk($codigo);
        $t08_pedidoForm = $this->getRequestParameter('t08_pedido');
/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t08_pedido->setCoProveedor($t08_pedidoForm["co_proveedor"]);
                                                
/*Campo tipo DATE */
list($dia, $mes, $anio) = explode("/",$t08_pedidoForm["fe_pedido"]);
$fecha = $anio."-".$mes."-".$dia;
$t08_pedido->setFePedido($fecha);
                
/*CAMPOS*/
        $t08_pedido->save($con);
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
        $t08_pedido = new T08Pedido();
        $t08_pedidoForm = $this->getRequestParameter('t08_pedido');

/*CAMPOS*/
                                        
/*Campo tipo INTEGER */
$t08_pedido->setCoProveedor($t08_pedidoForm["co_proveedor"]);
                                                
/*Campo tipo DATE */
list($dia, $mes, $anio) = explode("/",$t08_pedidoForm["fe_pedido"]);
$fecha = $anio."-".$mes."-".$dia;
$t08_pedido->setFePedido($fecha);
                
/*CAMPOS*/

        $t08_pedido->save($con);
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
	$codigo = $this->getRequestParameter("co_pedido");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t08_pedido = T08PedidoPeer::retrieveByPk($codigo);			
	$t08_pedido->delete($con);
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
                $co_proveedor      =   $this->getRequestParameter("co_proveedor");
            $fe_pedido      =   $this->getRequestParameter("fe_pedido");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_proveedor!=""){$c1->add(T08PedidoPeer::CO_PROVEEDOR,$co_proveedor);}
            
                                            
        if($fe_pedido!=""){
    list($dia, $mes,$anio) = explode("/",$fe_pedido);
    $fecha = $anio."-".$mes."-".$dia;
    $c1->add(T08PedidoPeer::FE_PEDIDO,$fecha);
    }
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T08PedidoPeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T08PedidoPeer::CO_PEDIDO);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                    if($co_proveedor!=""){$c->add(T08PedidoPeer::CO_PROVEEDOR,$co_proveedor);}
    
                                    
        if($fe_pedido!=""){
    list($dia, $mes,$anio) = explode("/",$fe_pedido);
    $fecha = $anio."-".$mes."-".$dia;
    $c->add(T08PedidoPeer::FE_PEDIDO,$fecha);
    }
                    }
    $c->setIgnoreCase(true);

    $stmt = T08PedidoPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_pedido"     => trim($res["co_pedido"]),
            "co_proveedor"     => trim($res["co_proveedor"]),
            "fe_pedido"     => trim($res["fe_pedido"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                    //modelo fk t06_proveedor.CO_PROVEEDOR
    public function executeStorefkcoproveedor(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T06ProveedorPeer::doSelectStmt($c);
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
