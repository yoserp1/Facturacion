<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Sistema de Facturacion</title>
	<link rel="shortcut icon" href="/facturacion/web/images/favicon.ico" />
<?= use_stylesheet("ext-all.min.css") ?>
<?= use_stylesheet("xtheme-silverCherry.css") ?>
<?= use_stylesheet("iconos.css") ?>
</head>
  <body background="#FFFFFF" >
    <style type="text/css">
        h1 {font: normal 60px tahoma, arial, verdana;color: #E1E1E1;}
        h2 {font: normal 20px tahoma, arial, verdana;color: #E1E1E1;}
        h2 a {text-decoration: none;color: #E1E1E1;}
        .x-window-mc {background-color : #F4F4F4 !important;}
    </style>
    <h1>Sistema de Facturacion</h1>
    <h2>Dimonca</h2>
	<div id="loading-mask" style=""></div>
  	<div id="loading">
		<div class="loading-indicator">
                <img src="/facturacion/web/images/blue-loading.gif" width="32" height="32" style="margin-right:8px; padding-left:120px; float:left;vertical-align:top;"/>
                 ..::Sistema de Facturacion::..<br />
                <span id="loading-msg">Cargando...</span>
            </div>
        </div>
   <!-- <img src="../images/banner.gif" align="bottom" width="100%" height="110"/>-->
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Cargando el Componente Central ...';</script>
<?= javascript_include_tag('ext-3.4.1/adapter/ext/ext-base.js'); ?>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Cargando la Interfaz Grafica...';</script>
<?= javascript_include_tag('ext-3.4.1/ext-all.js'); ?>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Cargando el idioma...';</script>
<?= javascript_include_tag('ext-3.4.1/locale/ext-lang-es.js'); ?>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Cargando Esquema General...';</script>
<?= javascript_include_tag('funciones_comunes/paqueteComun.js'); ?>
      <? echo $sf_content; ?>       
       <div id="winValidar">
          <div id="msgValidar" style="margin-bottom: 20px; font-size: 12px; font-weight: bold; color:#444; display: none">
            Acceso para usuarios registrados
          </div>
           <div id="principal" align="center" style="padding-bottom: 1%">
                     <!--<img src="images/pantalla.jpeg" align="bottom" width="20%" height="20%" style="margin-top: 100px;" />-->
            </div>         
       </div>  
	<div id="centro" align="center" style="padding-bottom: 1%">     
		<img src="/facturacion/web/images/logo.jpg"  width="200" style="position: absolute; top: 50%; right: 6px;" />
	</div> 
  </body>
 </html>
