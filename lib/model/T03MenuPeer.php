<?php

class T03MenuPeer extends BaseT03MenuPeer
{
  static public function  ArmaMenu($co_rol){
        /*
         * Se buscan las opciones de menu padre
         */
        $c= new Criteria();
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,0);
        $c->add(T04RolmenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        $c->addAscendingOrderByColumn(T03MenuPeer::NU_ORDEN);
        $res = T03MenuPeer::doSelect($c);

        $menu = '';
        foreach($res as $resul){
                $cantidad = T03MenuPeer::cantidad_hijos($resul->getCoMenu(),$co_rol);
                if($cantidad > 0)
                {
                       $menu.= "{
                                 text:'".$resul->getTxMenu()."',
                                 //expanded:true,
                                 children:[".T03MenuPeer::ArmaSubmenu($resul->getCoMenu(),$co_rol)."]
                                },";
                }	
        }
        return $menu;
    }

    static public function cantidad_hijos($co_padre,$co_rol){

        $c= new Criteria();
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,$co_padre);
        $c->add(T04RolmenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        return T03MenuPeer::doCount($c);
    }

     static public function cantidad_hijosPrivilegio($co_padre,$co_rol){

        $c= new Criteria();
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,$co_padre);
//        $c->add(T04RolMenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        return T03MenuPeer::doCount($c);
    }

   static public function ArmaSubmenu($co_padre,$co_rol){

        $c= new Criteria();
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,$co_padre);
        $c->add(T04RolmenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        $c->addAscendingOrderByColumn(T03MenuPeer::NU_ORDEN);
        $res = T03MenuPeer::doSelect($c);

        $submenu = '';
        foreach($res as $result){
            $cantidad = T03MenuPeer::cantidad_hijosPrivilegio($result->getCoMenu(),$co_rol);
            if($cantidad > 0)
            {
                 $cantidad_hijos = T03MenuPeer::cantidad_hijos($result->getCoMenu(),$co_rol);
                 if($cantidad_hijos > 0){
			$submenu.= "{
				text:'".$result->getTxMenu()."',
				children:[".T03MenuPeer::ArmaSubmenu($result->getCoMenu(),$co_rol)."]
			},";
                 }
            }else{
			$submenu.= "{
				id: '".$result->getCoMenu()."',
				url: '".$result->getTxHref()."',
				tabType:'load',
				text:'".$result->getTxMenu()."',
				iconCls:'".$result->getTxIcono()."',
				leaf:true
			},";
            }
        }
        return  $submenu;
    }

    static public function  ArmaMenuPrivilegio($co_rol){


        /*
         * Se buscan las opciones de menu padre
         */
        $c= new Criteria();
        $c->addSelectColumn(T04RolmenuPeer::CO_ROLMENU);
        $c->addSelectColumn(self::CO_MENU);
        $c->addSelectColumn(self::TX_MENU);
        $c->addSelectColumn(self::TX_ICONO);

        $c->addSelectColumn(T04RolmenuPeer::IN_VER);
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,0);
//        $c->add(T04RolmenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        $c->addAscendingOrderByColumn(T03MenuPeer::NU_ORDEN);
        $res = T03MenuPeer::doSelectStmt($c);

        $menu = '';
        foreach($res as $resul){

                $cantidad = T03MenuPeer::cantidad_hijosPrivilegio($resul['co_menu'],$co_rol);

                if($cantidad > 0)
                {

                       $menu.= "{
                                 text:'".$resul['tx_menu']."',
				expanded: true,
                                 children:[".T03MenuPeer::ArmaSubmenuPrivilegio($resul['co_menu'],$co_rol)."]
                                },";

                       

                }
        }

        return $menu;

    }

    static public function ArmaSubmenuPrivilegio($co_padre,$co_rol){

        $c= new Criteria();

        $c->addSelectColumn(T04RolmenuPeer::CO_ROLMENU);
        $c->addSelectColumn(self::CO_MENU);
        $c->addSelectColumn(self::TX_MENU);
        $c->addSelectColumn(self::TX_ICONO);
        $c->addSelectColumn(T04RolmenuPeer::IN_VER);
        
        $c->add(T04RolmenuPeer::CO_ROL,$co_rol);
        $c->add(T03MenuPeer::CO_PADRE,$co_padre);
//        $c->add(T04RolmenuPeer::IN_VER,'t');
        $c->addJoin(T03MenuPeer::CO_MENU,T04RolmenuPeer::CO_MENU);
        $c->addAscendingOrderByColumn(T03MenuPeer::NU_ORDEN);
        $res = T03MenuPeer::doSelectStmt($c);


        $submenu = '';

        foreach($res as $result){

            $cantidad = T03MenuPeer::cantidad_hijosPrivilegio($result['co_menu'],$co_rol);

            if($cantidad > 0)
            {

                       $submenu.= "{
                                 text:'".$result['tx_menu']."',
                                 id:'".$result['co_rolmenu']."',
                                 children:[".T03MenuPeer::ArmaSubmenuPrivilegio($result['co_menu'],$co_rol)."]
                                 },";

                      

            }else{

                $submenu.= "{
                                    text:'".$result['tx_menu']."',
                                    id:'".$result['co_rolmenu']."',
                                    iconCls:'".$result['tx_icono']."',
                                    leaf:true, ";
                if($result['in_ver']==1)
                 $submenu.= "       checked: true },";
                else
                 $submenu.= "       checked: false },";
            }

        }

        return  $submenu;

    }

}
