<?php

class T01UsuarioPeer extends BaseT01UsuarioPeer
{
	static public function getDatosUsuario($usuario,$password){

          $c= new Criteria();
          $c->add(T01UsuarioPeer::TX_LOGIN,$usuario);
          $c->add(T01UsuarioPeer::TX_PASSWORD,$password);
	  $c->add(T01UsuarioPeer::IN_ACTIVO,true);
          $res = T01UsuarioPeer::doSelect($c);

          foreach($res as $result)
            return $result;
    }

    static public function getBuscaUsuario($co_usuario){

          $c = new Criteria();

          $c->addAnd(self::CO_USUARIO,$co_usuario);
          $stmt = self::doSelectStmt($c);

          $data="";
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
             $data[]=$row;
          }
          return $data;

    }
}
