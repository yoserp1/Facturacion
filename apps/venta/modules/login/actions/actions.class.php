<?php

/**
 * login actions.
 *
 * @package    facturacion
 * @subpackage login
 * @author     renny
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class loginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->getUser()->setAttribute('nombre','');
     $this->getUser()->setAttribute('codigo','');
     $this->getUser()->setAttribute('rol','');
  }

  public function executeValidar(sfWebRequest $request)
  {
     $usuario = $this->getRequestParameter('usuario');
     $password = $this->getRequestParameter('password');
     $codigoseg = $this->getRequestParameter('codigoseg');
	if($usuario==""){      
		$this->getUser()->setAuthenticated(false);
		$this->redirect('/facturacion/web/');
	}
     $this->datos = T01UsuarioPeer::getDatosUsuario($usuario, md5($password));
     $this->codigoseg = $codigoseg;
     $this->captcha=$_SESSION['codigo_seguridad'];
     if(($this->datos!="")&&($codigoseg==$this->captcha)){
	     $this->codigo = $this->datos->getCoUsuario();
	     $this->nombre = $this->datos->getNbUsuario().' '.$this->datos->getApUsuario();
	     $this->co_rol = $this->datos->getCoRol();

	     $this->getUser()->setAttribute('nombre', $this->nombre);
	     $this->getUser()->setAttribute('codigo', $this->codigo);
	     $this->getUser()->setAttribute('rol', $this->co_rol);
	     $this->getUser()->setAuthenticated(true);
	     $this->url = $_SERVER["SCRIPT_NAME"]."/inicio";
  	}
  }

  public function executeLimpiar(sfWebRequest $request)
  {
      $this->getUser()->setAuthenticated(false);
      $this->redirect('/facturacion/web/');
  }

}
