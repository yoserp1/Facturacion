<?php

/**
 * usuario actions.
 *
 * @package    facturacion
 * @subpackage usuario
 * @author     renny
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class UsuarioActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('usuario', 'lista');
  }

  public function executeNuevo(sfWebRequest $request)
  {
    $this->forward('usuario', 'editar');
  }

  public function executeFiltro(sfWebRequest $request)
  {

  }
   /*
   * Cambio de Clave
   */

  public function executeCambioClave(){

  }


  public function executeEdit($request){

        $this->respuesta = 1;

        if ($request->isMethod('post'))
        {
         $con = Propel::getConnection();
          try
          {
             $this->guardarClave($con);

             $con->commit();
          }
          catch (PropelException $e)
          {
            $con->rollBack();
            $this->respuesta = $e->getMessage();
          }
        }
    }

    protected function guardarClave($con)
    {
        $codigo = $this->getUser()->getAttribute('codigo');
        $clave = $this->getRequestParameter('clave');
        $confirmacion = $this->getRequestParameter('confirmacion');

        $Usuario = T01UsuarioPeer::retrieveByPK($codigo);

        if($clave === $confirmacion){
            $Usuario->setTxPassword(md5($clave))->save($con);

        }else{
            $this->respuesta = "La contraseña y la confirmacion no coinciden";
        }

    }

  /*
   *
   * fin Cambio de clave
   */

  public function executeEditar(sfWebRequest $request)
  {
    $codigo = $this->getRequestParameter("codigo");
    if($codigo!=''||$codigo!=null){
        $c = new Criteria();
                $c->add(T01UsuarioPeer::CO_USUARIO,$codigo);
        
        $stmt = T01UsuarioPeer::doSelectStmt($c);
        $campos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->data = json_encode(array(
                            "co_usuario"     => $campos["co_usuario"],
                            "nb_usuario"     => $campos["nb_usuario"],
                            "ap_usuario"     => $campos["ap_usuario"],
                            "nu_cedula"     => $campos["nu_cedula"],
                            "tx_login"     => $campos["tx_login"],
                            "tx_password"     => $campos["tx_password"],
                            "co_rol"     => $campos["co_rol"],
                    ));
    }else{
        $this->data = json_encode(array(
                            "co_usuario"     => "",
                            "nb_usuario"     => "",
                            "ap_usuario"     => "",
                            "nu_cedula"     => "",
                            "tx_login"     => "",
                            "tx_password"     => "",
                            "co_rol"     => "",
                    ));
    }

  }

  public function executeGuardar(sfWebRequest $request)
  {

    $codigo = $this->getRequestParameter("co_usuario");
     if($codigo!=''||$codigo!=null){
     $con = Propel::getConnection();
     try
      { 
        $con->beginTransaction();
        $t01_usuario = T01UsuarioPeer::retrieveByPk($codigo);
        $t01_usuarioForm = $this->getRequestParameter('t01_usuario');
/*CAMPOS*/
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setNbUsuario($t01_usuarioForm["nb_usuario"]);
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setApUsuario($t01_usuarioForm["ap_usuario"]);
                                        
/*Campo tipo NUMERIC */
$t01_usuario->setNuCedula($t01_usuarioForm["nu_cedula"]);
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setTxLogin($t01_usuarioForm["tx_login"]);
                                        
/*Campo tipo INTEGER */
$t01_usuario->setCoRol($t01_usuarioForm["co_rol"]);
                
/*CAMPOS*/
        $t01_usuario->save($con);
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
        $t01_usuario = new T01Usuario();
        $t01_usuarioForm = $this->getRequestParameter('t01_usuario');

/*CAMPOS*/
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setNbUsuario($t01_usuarioForm["nb_usuario"]);
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setApUsuario($t01_usuarioForm["ap_usuario"]);
                                        
/*Campo tipo NUMERIC */
$t01_usuario->setNuCedula($t01_usuarioForm["nu_cedula"]);
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setTxLogin($t01_usuarioForm["tx_login"]);
                                        
/*Campo tipo VARCHAR */
$t01_usuario->setTxPassword(md5(123456));
                                        
/*Campo tipo INTEGER */
$t01_usuario->setCoRol($t01_usuarioForm["co_rol"]);

/*Campo tipo BOOLEAN */
$t01_usuario->setInActivo(true);
                
/*CAMPOS*/

        $t01_usuario->save($con);
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
	$codigo = $this->getRequestParameter("co_usuario");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t01_usuario = T01UsuarioPeer::retrieveByPk($codigo);			
	$t01_usuario->delete($con);
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

  public function executeResetear(sfWebRequest $request)
  {
	$codigo = $this->getRequestParameter("co_usuario");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t01_usuario = T01UsuarioPeer::retrieveByPk($codigo);
	$t01_usuario->setTxPassword(md5(123456));			
	$t01_usuario->save($con);
		$this->data = json_encode(array(
			    "success" => true,
			    "msg" => 'Clave Reseteada con exito!'
		));
	$con->commit();
	}catch (PropelException $e)
	{
	$con->rollback();
		$this->data = json_encode(array(
		    "success" => false,
		    "msg" =>  $e->getMessage()
//		    "msg" => 'Este registro no se puede Resetear porque <br>se encuentra asociado a otros registros'
		));
	}
  }

  public function executeDesabilitar(sfWebRequest $request)
  {
	$codigo = $this->getRequestParameter("co_usuario");
	$con = Propel::getConnection();
	try
	{ 
	$con->beginTransaction();
	/*CAMPOS*/
	$t01_usuario = T01UsuarioPeer::retrieveByPk($codigo);
	$t01_usuario->setInActivo(false);			
	$t01_usuario->save($con);
		$this->data = json_encode(array(
			    "success" => true,
			    "msg" => 'Usuario Desabilitado!'
		));
	$con->commit();
	}catch (PropelException $e)
	{
	$con->rollback();
		$this->data = json_encode(array(
		    "success" => false,
//		    "msg" =>  $e->getMessage()
		    "msg" => 'Este registro no se puede Resetear porque <br>se encuentra asociado a otros registros'
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
                $nb_usuario      =   $this->getRequestParameter("nb_usuario");
            $ap_usuario      =   $this->getRequestParameter("ap_usuario");
            $nu_cedula      =   $this->getRequestParameter("nu_cedula");
            $tx_login      =   $this->getRequestParameter("tx_login");
            $tx_password      =   $this->getRequestParameter("tx_password");
            $co_rol      =   $this->getRequestParameter("co_rol");
    
    $c1 = new Criteria();

    if($this->getRequestParameter("BuscarBy")=="true"){
                                if($nb_usuario!=""){$c1->add(T01UsuarioPeer::NB_USUARIO,'%'.$nb_usuario.'%',Criteria::LIKE);}
                
                                        if($ap_usuario!=""){$c1->add(T01UsuarioPeer::AP_USUARIO,'%'.$ap_usuario.'%',Criteria::LIKE);}
                
                                            if($nu_cedula!=""){$c1->add(T01UsuarioPeer::NU_CEDULA,$nu_cedula);}
            
                                        if($tx_login!=""){$c1->add(T01UsuarioPeer::TX_LOGIN,'%'.$tx_login.'%',Criteria::LIKE);}
                
                                        if($tx_password!=""){$c1->add(T01UsuarioPeer::TX_PASSWORD,'%'.$tx_password.'%',Criteria::LIKE);}
                
                                            if($co_rol!=""){$c1->add(T01UsuarioPeer::CO_ROL,$co_rol);}
            
                    }
    $c1->setIgnoreCase(true);
    $cantidadTotal = T01UsuarioPeer::doCount($c1);

    $c = new Criteria();

    if($paginar=='si') $c->setLimit($limit)->setOffset($start);
        $c->addAscendingOrderByColumn(T01UsuarioPeer::CO_USUARIO);
    
    if($this->getRequestParameter("BuscarBy")=="true"){
                                if($nb_usuario!=""){$c->add(T01UsuarioPeer::NB_USUARIO,'%'.$nb_usuario.'%',Criteria::LIKE);}
        
                                        if($ap_usuario!=""){$c->add(T01UsuarioPeer::AP_USUARIO,'%'.$ap_usuario.'%',Criteria::LIKE);}
        
                                            if($nu_cedula!=""){$c->add(T01UsuarioPeer::NU_CEDULA,$nu_cedula);}
    
                                        if($tx_login!=""){$c->add(T01UsuarioPeer::TX_LOGIN,'%'.$tx_login.'%',Criteria::LIKE);}
        
                                        if($tx_password!=""){$c->add(T01UsuarioPeer::TX_PASSWORD,'%'.$tx_password.'%',Criteria::LIKE);}
        
                                            if($co_rol!=""){$c->add(T01UsuarioPeer::CO_ROL,$co_rol);}
    
                    }
    $c->setIgnoreCase(true);
	   	$c->clearSelectColumns();
	    	$c->addSelectColumn(T01UsuarioPeer::CO_USUARIO);
		$c->addSelectColumn(T01UsuarioPeer::NB_USUARIO);
		$c->addSelectColumn(T01UsuarioPeer::AP_USUARIO);
		$c->addSelectColumn(T01UsuarioPeer::NU_CEDULA);
		$c->addSelectColumn(T01UsuarioPeer::TX_LOGIN);
		$c->addSelectColumn(T02RolPeer::TX_ROL);
		$c->addSelectColumn(T01UsuarioPeer::IN_ACTIVO);
		$c->addJoin(T01UsuarioPeer::CO_ROL, T02RolPeer::CO_ROL);
    $stmt = T01UsuarioPeer::doSelectStmt($c);
    $registros = "";
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $registros[] = array(
            "co_usuario"     => trim($res["co_usuario"]),
            "nb_usuario"     => trim($res["nb_usuario"]),
            "ap_usuario"     => trim($res["ap_usuario"]),
            "nu_cedula"     => trim($res["nu_cedula"]),
            "tx_login"     => trim($res["tx_login"]),
            "co_rol"     => trim($res["tx_rol"]),
	    "in_activo"     => trim($res["in_activo"]),
        );
    }

    $this->data = json_encode(array(
        "success"   =>  true,
        "total"     =>  $cantidadTotal,
        "data"      =>  $registros
        ));
    }

                                                                                //modelo fk t02_rol.CO_ROL
    public function executeStorefkcorol(sfWebRequest $request){
        $c = new Criteria();
        $stmt = T02RolPeer::doSelectStmt($c);
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
