<?php

/**
 * inicio actions.
 *
 * @package    facturacion
 * @subpackage inicio
 * @author     renny
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inicioActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->nombre = $this->getUser()->getAttribute('nombre');
      $this->getRequest()->setAttribute('titulo', $this->nombre);

     $menu = T03MenuPeer::ArmaMenu($this->getUser()->getAttribute('rol')); 
     $this->getRequest()->setAttribute('menu', $menu);
     $this->usuario = $this->getUser()->setAttribute('member_id', $this->nombre); 

      if($this->nombre==''){
        $this->redirect('<?php echo $_SERVER["SCRIPT_NAME"] ?>');
      }else{
         $this->getUser()->setAuthenticated(true);      
      }
  }
}
