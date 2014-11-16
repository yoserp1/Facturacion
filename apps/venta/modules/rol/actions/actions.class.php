<?php

/**
 * rol actions.
 *
 * @package    facturacion
 * @subpackage rol
 * @author     renny
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class rolActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('rol', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
//    $this->forward('rol', 'editar');
        $this->data = json_encode(array(
                            "co_rol"     => "",
                            "tx_rol"     => "",
                    ));
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T02RolPeer::CO_ROL,$codigo);
        
        $stmt = T02RolPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_rol"     => $campos["co_rol"],
                            "tx_rol"     => $campos["tx_rol"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_rol"     => "",
                            "tx_rol"     => "",
                    ));
    }
      $this->menu = T03MenuPeer::ArmaMenuPrivilegio($this->getRequestParameter('codigo'));
      $this->co_rol = $this->getRequestParameter('codigo');
  }

  public function executeGuardar(sfWebRequest $request)
  {
	$json  = json_decode($this->getRequestParameter('arreglo'),true);
	$opciones = $json['opcion'];

	$codigo = $this->getRequestParameter("co_rol");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t02_rol = T02RolPeer::retrieveByPk($codigo);
        $t02_rolForm = $this->getRequestParameter('t02_rol');
/*CAMPOS*/
                                        
/*Campo tipo VARCHAR */
$t02_rol->setTxRol($t02_rolForm["tx_rol"]);
                
/*CAMPOS*/

        $t02_rol->save($con);

          /*habilita los padres*/
          $data = '';
          $stmt = $con->prepare("update t04_rolmenu
                                    set in_ver = true
                                  where co_rolmenu in(
                                         select co_rolmenu from vista_rolmenu where co_rol = $codigo and cant > 0)");
          $stmt->execute();

          /*de desabilitan todos los hijos*/
          $data = '';
          $stmt2 = $con->prepare("update t04_rolmenu
                                    set in_ver = false
                                  where co_rolmenu in(
                                         select co_rolmenu from vista_rolmenu where co_rol = $codigo and cant = 0)");
          $stmt2->execute();

	foreach ($opciones as $lista){
		$menu = T04RolmenuPeer::retrieveByPK($lista);
		$menu->setInVer(true)->save($con);
	}
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
        $t02_rol = new T02Rol();
        $t02_rolForm = $this->getRequestParameter('t02_rol');

/*CAMPOS*/
                                        
/*Campo tipo VARCHAR */
$t02_rol->setTxRol($t02_rolForm["tx_rol"]);
                
/*CAMPOS*/

        $t02_rol->save($con);
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

  public function executeLista(sfWebRequest $request)
  {

  }

  public function executeStorelista(sfWebRequest $request)
  {
    $paginar    =   $this->getRequestParameter("paginar");
    $limit      =   $this->getRequestParameter("limit",10);
    $start      =   $this->getRequestParameter("start",0);
                $tx_rol      =   $this->getRequestParameter("tx_rol");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                if($tx_rol!=""){$c1->add(T02RolPeer::TX_ROL,'%'.$tx_rol.'%',Criteria::LIKE);}
                
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T02RolPeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T02RolPeer::CO_ROL);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                if($tx_rol!=""){$c->add(T02RolPeer::TX_ROL,'%'.$tx_rol.'%',Criteria::LIKE);}
        
                    }
    $c->setIgnoreCase(true);

    $stmt = T02RolPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_rol"     => trim($res["co_rol"]),
            "tx_rol"     => trim($res["tx_rol"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                    


}
