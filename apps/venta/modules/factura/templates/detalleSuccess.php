<script type="text/javascript">
Ext.ns('datos');
datos.main = {
init: function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});

this.datos = '<p class="registro_detalle"><b>Codigo: </b>'+this.OBJ.co_factura+'</p>';
this.datos +='<p class="registro_detalle"><b>Fecha: </b>'+this.OBJ.fe_factura+'</p>';
this.datos +='<p class="registro_detalle"><b>Tipo de Factura: </b>'+this.OBJ.co_tipo_factura+'</p>';
this.datos +='<p class="registro_detalle"><b>Monto Neto: </b>'+this.OBJ.mo_neto+'<b> Monto I.V.A: </b>'+this.OBJ.mo_iva+'</p>';
this.datos +='<p class="registro_detalle"><b>Monto a Pagar: </b>'+this.OBJ.mo_total+'</p>';

this.datos2 = '<p class="registro_detalle"><b>Cedula / Rif: </b>'+this.OBJ.co_documento+'-'+this.OBJ.tx_dni+'</p>';
this.datos2 +='<p class="registro_detalle"><b>Nombre y Apellido: </b>'+this.OBJ.tx_nombre+'</p>';
this.datos2 +='<p class="registro_detalle"><b>Direccion: </b>'+this.OBJ.tx_direccion+'</p>';
this.datos2 +='<p class="registro_detalle"><b>Telefono Movil: </b>'+this.OBJ.tx_telefono+'<b> Limite de Credito: </b>'+this.OBJ.nu_limite_credito+'</p>';

this.fieldDatos = new Ext.form.FieldSet({
	title: 'Datos de la Factura',
	html: this.datos
});

this.fieldDatos2 = new Ext.form.FieldSet({
	title: 'Datos del Cliente',
	html: this.datos2
});

//Editar un registro
this.editar= new Ext.Button({
    text:'Editar Factura',
    iconCls: 'icon-editar',
    handler:function(){
	this.codigo  = facturaLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura');
	facturaLista.main.mascara.show();
        this.msg = Ext.get('formulariofactura');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/editar/codigo/"+this.codigo,
         scripts: true,
         text: "Cargando.."
        });
    }
});

this.editar.disable();

this.imprimir = new Ext.Button({
	text:'Imprimir Factura',
	id:'imprimirPlanilla',
	iconCls: 'icon-pdf',
	handler: function(boton){
		  var vco_factura  = facturaLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura');
		  window.open("../reportes/factura?codigo="+vco_factura);
	}
});

this.formpanel = new Ext.form.FormPanel({
	bodyStyle: 'padding:10px',
	autoWidth:true,
	autoHeight:true,
        border:false,
        tbar:[
		this.editar,'-',this.imprimir
        ],
	items:[
		this.fieldDatos,this.fieldDatos2		
		]
});

	this.tabuladores = new Ext.TabPanel({
		resizeTabs:true, // turn on tab resizing
		minTabWidth: 115,
		tabWidth:150,border:false,
		enableTabScroll:true,
		width:500,
		autoHeight:250,
		activeTab: 0,
		defaults: {autoScroll:true},
		items:[
			{
				title: 'Datos de la Factura',
				items:[this.formpanel]
			}
		]
	});

        this.tabuladores.render('detalle');
}
}
Ext.onReady(datos.main.init, datos.main);
</script>
