<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<title>Sistema de Facturacion</title>
  <head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>

<?= use_stylesheet("ext-all.min.css") ?>
<?= use_stylesheet("iconos.css") ?>
<?= use_stylesheet("combos.css") ?>
<?= use_stylesheet("fileuploadfield.css") ?>
<?= javascript_include_tag('ext-3.4.1/adapter/ext/ext-base.js'); ?>
<?= javascript_include_tag('ext-3.4.1/ext-all.js'); ?>
<?= javascript_include_tag('funciones_comunes/paqueteComun.js'); ?>
<?= javascript_include_tag('open/js/swfobject.js'); ?>
<?= javascript_include_tag('ext-3.4.1/locale/ext-lang-es.js'); ?>
<?= javascript_include_tag('ext-3.4.1/ux/fileuploadfield/FileUploadField.js'); ?>
<?= javascript_include_tag('ext-3.4.1/ux/GroupSummary.js'); ?>
<?= javascript_include_tag('ext-3.4.1/ux/statusbar/StatusBar.js'); ?>

<link rel="shortcut icon" href="../../web/images/favicon.ico" />
<script type="text/javascript">
this.panel_detalle =  new Ext.Panel({
        region: 'east', //
        title: 'Detalles del Registro',
        id: 'detalle_registro',
        collapsible: true,
        collapseMode: 'mini',
        collapsed:true,
        split: true,
        autoScroll: true,
        titleCollapse: true,
        deferredRender: false,
        width:502,
	margins: '0 0 5 0',
        script:true,
	iconCls: 'icon-reporteest',
        items:[
		new Ext.Panel({id: 'detalle'})
        ]
});
this.comboTemas = new Ext.ux.ThemeCombo({
	width:100
});
this.tabpanel = new Ext.TabPanel({
	region: 'center',
	deferredRender: false,
	border:true,
	autoScroll: false,
	enableTabScroll:true,
	activeItem:0,
	listeners: {'tabchange': function(tabPanel, tab){panel_detalle.collapse();}},
	items:[{
		id: 'tabPrincipal',
		border:false,
		title: 'Inicio',
                autoScroll:true,
		iconCls:'icon-inicio',
		contentEl:'centro'
	}]
});
Ext.onReady(function(){
var arbol = new Ext.tree.TreePanel({
	id:'menu',
	rootVisible:false,
	lines:true,
	autoScroll:true,
	border: false,
	autoHeight:true,
	iconCls:'nav',
	useArrows: true,
	listeners: {
	    click : {
	    scope : this,
	    fn    : function( n, e ) 
	    {
		if(n.leaf){
		    //Accedemos a los a atributod del json que usamos para crear el nodo con
		    myobject = n;
		    if (n.attributes.url){url = n.attributes.url;} else {url =n.id;}
		    //Abrimos el nuevo tab
		    addTab(n.id,n.text,url,n.attributes.tabType,n.attributes.iconCls);
		}
	    }
	}
	},
	loader: new Ext.tree.TreeLoader(),
	root: new Ext.tree.AsyncTreeNode({
		children:[<?php echo $sf_request->getAttribute('menu'); ?>]
	})
});  
this.reloj = new Ext.Toolbar.TextItem('');
//correr reloj
Ext.TaskMgr.start({run: function(){Ext.fly(reloj.getEl()).update(new Date().format('g:i:s A'));},interval: 1000});
//barra de estatus
this.estatusbar = new Ext.Toolbar({items:['Sesion Iniciada','-',this.reloj,'-',this.comboTemas]}); 
var viewport = new Ext.Viewport({
	layout: 'border',
	items: [
		new Ext.BoxComponent({
		region: 'north',
		height: 33,
		contentEl:'header'
	}),{
		region: 'west',
		id: 'navegador',
		title: 'Menu del Sistema',
		iconCls: 'icon-navegacion',
		split: true,
		width: 270,
		minSize: 200,
		maxSize: 600,
		autoScroll:true,
		collapsible: true,
		collapsedTitle: true,
		animCollapse: true,
		margins: '0 0 0 0',
		bbar: this.estatusbar,
		items: [arbol]
	},
		this.tabpanel,
		this.panel_detalle
	]
});
	new Ext.Button({
		text: 'Cerrar sesi&oacute;n',
		handler: logOut,
		iconCls:'icon-salir2',
		renderTo:'btnSalir'
	});
});
function showResult(btn){
	if(btn=="yes"){
		Ext.MessageBox.show({title: 'Cerrando sesi&oacute;n', msg: '<br>Por favor  Espere...',width:300,closable:false,icon:Ext.MessageBox.INFO});
		location.href='<?= $_SERVER['SCRIPT_NAME']; ?>/login/limpiar';
	}
}
function logOut(){
	Ext.MessageBox.confirm('Confirmar', 'Seguro que desea salir de la Aplicaci&oacute;n?', showResult);
}
</script>
</head>
<div id="header" class="x-panel-header" style="margin:0px 0px 0px 0px; padding: 2px 2px 2px 10px;"> 
	<div style="float:left; width:600px; font-size:18px; line-height:22px; ">
		..::Sistema de Facturacion::..
	</div>	
	<div id="usuarioConectado" style="float:right; padding:2px 20px 2px 20px; border:1px solid #AABBCC; background: #E8E8E8">
	<div style="float:left; margin-right: 20px; vertical-align: bottom; font-size: 11px; color:#444 ">
	 	<img src="../images/user.gif" align="bottom" style="margin-right: 5px;"/> <?php echo $sf_request->getAttribute('titulo'); ?> </div>
	 	<div id="btnSalir" style="float:left; margin-left: 20px">
	</div>
</div>
<body style="background: #FFFFFF">
	<div id="centro" align="center" style="padding-bottom: 1%;width:100%;height:600px;">     
<!--	<img src="../../web/images/logo.png" width="500" height="250"/>-->
	<img src="../../web/images/logo.jpg"  width="200" style="position: absolute; top: 50%; right: 6px;" />
	</div>
	<div id="centro" class="x-hide-display"><?php echo $sf_content ?></div>
</body>
</html>
